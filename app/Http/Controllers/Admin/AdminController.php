<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\TempRegistration;
use App\Helpers\MainHelper;
use View;

class AdminController extends Controller
{
    protected $guard = 'admin';
    protected $admin = null;

    public function __construct() {
        $except = ['login', 'logout'];
        $this->middleware(function ($request, $next) {
            if (!Auth::guard($this->guard)->check()) {
                return redirect()->route('admin.login');
            }
            $this->admin = Auth::guard($this->guard)->user();
            View::share(['admin' => $this->admin]);
            return $next($request);
        })->except($except);
    }

    public function login(Request $request)
    {
        if (Auth::guard($this->guard)->check()) {
            return redirect()->route('admin.dashboard');
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
                return redirect()->route('admin.login')
                                ->withErrors($validator)
                                ->withInput();
            } else {
                // check if admin is locked
                $admin = Admin::where('email', $request->email)->first();
                if ($admin && $admin->locked == 1) {
                    $message = 'User is not activated. Please check your email to activate first.';
                    return redirect()->route('admin.login')
                        ->with(compact('message'))
                        ->withInput();
                }

                $credential = [
                    'email'=>$data['email'],
                    'password'=>$data['password']
                ];
                if(Auth::guard($this->guard)->attempt($credential)) {
                    return redirect()->route('admin.dashboard');
                }
                else{
                    $message = 'The credentials did not match';
                    return redirect()->route('admin.login')
                        ->with('message',$message)
                        ->withInput();
                }
            }
        }

        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard($this->guard)->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request)
    {
        return view('admin.dashboard');
    }

    public function checkRole()
    {
        return 'show role';
    }


}
