<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home');
    }

    public function routeName($slug)
    {
        // check category
        $category = Category::where('slug',$slug)->first();
        if(!empty($category)) {
            $postList = $category->posts()->paginate(10);
            return view('front.category.index',compact('category', 'postList'));
        }

        // check post
        $post = Post::where('route', $slug) ->first();
        if(!empty($post)) {

            return view('front.post.index', compact('post'));
        }

        return view('front.error');
    }


}
