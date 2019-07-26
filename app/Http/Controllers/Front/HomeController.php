<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use View;

class HomeController extends Controller
{
    protected $guard = 'user';
    protected $user = null;

    public function __construct() {
        if (Auth::guard($this->guard)->check()) {
            $this->user = Auth::guard($this->guard)->user();
        }
        View::share(['user' => $this->user]);
    }

    public function index()
    {
        return view('front.home');
    }

    public function routeName($slug)
    {
        // check category
        $category = Category::where('slug',$slug)
                                ->where('active_flg', 1)
                                ->first();
        if(!empty($category)) {
            $postList = $category->posts()->paginate(10);
            return view('front.category.index',compact('category', 'postList', 'slug'));
        }

        // check post
        $post = Post::where('route', $slug) ->first();
        if(!empty($post)) {

            return view('front.post.index', compact('post', 'slug'));
        }

        return view('front.error');
    }


}
