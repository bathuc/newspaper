<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\MainHelper;
use App\Models\Post;
use App\Models\Category;

class PostController extends AdminController
{
    public function post(Request $request)
    {
        if($request->isMethod('post')) {

        }

        $posts = Post::paginate(15);
        return view('admin.post.post', compact('posts'));
    }

    public function newPost(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);
            if ($validator->fails()) {
                // fail
                return redirect()->route('admin.new_post')
                                ->withErrors($validator)
                                ->withInput();
            } else {
                // success
                $row = [
                    'route' => MainHelper::getRouteName($data['title']),
                    'category_id' => $data['category_id'],
                    'title' => $data['title'],
                    'content' => $data['content'],
                ];

                $postId = Post::insertGetId($row);

                return redirect()->route('admin.edit_post', ['id' => $postId]);
            }

        }

        $categoryList = Category::getCategoryView(4);

        return view('admin.post.new_post', compact('categoryList'));
    }

    public function editPost(Request $request)
    {
        return view('admin.post.edit_post');
    }

    public function deletePost(Request $request)
    {
        return view('admin.post.delete_post');
    }
}
