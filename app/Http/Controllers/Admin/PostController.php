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
        $posts = Post::orderby('id','desc')->paginate(15);
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
                $timenow = date('Y-m-d H:i:s');
                $row = [
                    'route' => MainHelper::getRouteName($data['title']),
                    'category_id' => $data['category_id'],
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'created_at' => $timenow,
                    'updated_at' => $timenow,
                ];

                $postId = Post::insertGetId($row);

                return redirect()->route('admin.edit_post', ['id' => $postId]);
            }

        }

        $categoryList = Category::getCategoryView();

        return view('admin.post.new_post', compact('categoryList'));
    }

    public function editPost(Request $request, $id)
    {
        $post = Post::find($id);
        if(empty($post)) {
            return redirect()->route('admin.post');
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);
            if ($validator->fails()) {
                // fail
                return redirect()->route('admin.edit_post')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                // success
                $timenow = date('Y-m-d H:i:s');
                $row = [
                    'category_id' => $data['category_id'],
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'updated_at' => $timenow,
                ];

                Post::where('id',$id)->update($row);
            }
        }

        $post = Post::find($id);
        $categoryList = Category::getCategoryView();
        return view('admin.post.edit_post', compact('post', 'categoryList'));
    }

    public function deletePost(Request $request)
    {
        return view('admin.post.delete_post');
    }
}
