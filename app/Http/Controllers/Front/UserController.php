<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TempRegistration;
use App\Helpers\MainHelper;
use View;

class UserController extends Controller
{
    protected $guard = 'user';
    protected $user = null;

    public function __construct() {
        $except = ['login', 'logout', 'dashboard', 'register', 'registerThanks', 'activateUser',];
        $this->middleware(function ($request, $next) {
            if (!Auth::guard($this->guard)->check()) {
                return redirect()->route('user.login');
            }
            $this->user = Auth::guard($this->guard)->user();
            View::share(['user' => $this->user]);
            return $next($request);
        })->except($except);
    }

    public function login(Request $request)
    {
        if (Auth::guard($this->guard)->check()) {
            return redirect()->route('user.dashboard');
        }

        $message = '';
        if($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:5',
            ]);

            if ($validator->fails()) {
                // fail
                return redirect()->route('user.login')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                // check if user is locked
                $user = User::where('email', $request->email)->first();
                if ($user && $user->locked == 1) {
                    $message = 'User is not activated. Please check your email to activate first.';
                    return redirect()->route('user.login')
                        ->with(compact('message'))
                        ->withInput();
                }

                $credential = [
                    'email'=>$data['email'],
                    'password'=>$data['password']
                ];
                if(Auth::guard($this->guard)->attempt($credential)) {
                    return redirect()->route('user.dashboard');
                }
                else{
                    $message = 'The credentials did not match';
                    return redirect()->route('user.login')
                        ->with('message',$message)
                        ->withInput();
                }
            }
        }

        return view('user.login');
    }

    public function logout()
    {
        Auth::guard($this->guard)->logout();
        return redirect()->route('user.login');
    }

    public function dashboard(Request $request)
    {
        return view('user.dashboard');
    }

    public function register(Request $request)
    {
        $message = ''; $alert = 'error';
        if($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:5|confirmed', // password_confirmation field must be present in the input.
            ]);
            if ($validator->fails()) {
                // fail
                return redirect()->route('user.register')
                    ->withErrors($validator)
                    ->withInput();

            } else {
                // successful register
                $user = User::where('email',$data['email'])->first();
                if($user){
                    if($user->locked == 0){
                        // user is exit and active
                        $message = 'User is already exit!';
                    }
                    else{
                        //user is already exit, but time is expire
                        $timenow = date('Y-m-d H:i:s');
                        $expiration = date('Y-m-d H:i:s', strtotime('+3 day', time()));
                        $temp = TempRegistration::where([['from', '=', 'user'],['email', '=', $data['email']],])->first();
                        if($temp && $temp->expiration < $timenow){
                            // update user password, update time expiration & send mail activate
                            $user->name =     $data['name'];
                            $user->password = Hash::make($data['password']);
                            $user->save();

                            $token = MainHelper::getHashPath();
                            $temp->expiration = $expiration;
                            $temp->token = $token;
                            $temp->save();

                            $url = url("/activate/" . $token);
                            MainHelper::sendMailActivateUser($temp->email, $url);
                            return redirect()->route('user.register.register_thanks');
                        }
                    }
                }
                else{
                    // new registration
                    $data = [
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'image_hash_path' => MainHelper::getHashPath(),
                        'locked' => 1,
                    ];

                    User::insert($data);

                    $token = MainHelper::getHashPath();
                    $expiration = date('Y-m-d H:i:s', strtotime('+3 day', time()));
                    $temp = [
                        'from' => 'user',
                        'token' => $token,
                        'email' => $data['email'],
                        'password' => 'null',
                        'expiration' => $expiration,
                    ];

                    TempRegistration::insert($temp);

                    $url = url("/activate/" . $token);
                    MainHelper::sendMailActivateUser($data['email'], $url);
                    return redirect()->route('user.register_thanks');
                }
            }

        }
        return view('user.register.register', compact('message', 'alert'));
    }

    public function registerThanks()
    {
        return view('user.register.register_thanks');
    }

    public function activateUser($token)
    {
        $message = ''; $alert = 'error'; $userActive = 0;
        $timenow = date('Y-m-d H:i:s');
        $temp = TempRegistration::where([
            ['from', '=', 'user'],
            ['token', '=', $token],
        ])->first();

        if($temp) {
            // valid time
            if($temp->expiration >= $timenow){
                User::where('email',$temp->email)->update(['locked'=>0]);
                $temp->expiration = $timenow;
                $temp->save();
                $message = 'User is activated. ';
                $userActive = 1;
                $alert = 'success';
            }
            else{
                $message = 'Activate link was expired. Please register again.';
            }
        }
        else {
            $message = 'Token is invalid. Please register again.';
        }

        return view('user.register.register_activate', compact('message', 'alert', 'userActive'));
    }

    public function resetPassword(Request $request)
    {
        $message = ''; $alert = 'error';
        if($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'oldPassword' => 'required|string|min:5',
                'newPassword' => 'required|string|min:5',
                'confirmNewPassword' => 'required|same:newPassword',
            ]);
            if ($validator->fails()) {
                // fail
                return redirect()->route('user.reset_password')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if (Hash::check($data['oldPassword'], $this->user->password)) {
                    $this->user->password = Hash::make($data['newPassword']);
                    $this->user->save();
                    $alert = 'success';
                    $message = 'Password changed successfully!';
                }
                else {
                    $message = 'Old password did not match';
                }
            }

        }

        return view('user.reset_password')->with(compact('message', 'alert'));
    }
}
