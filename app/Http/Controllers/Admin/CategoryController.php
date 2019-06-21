<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\MainHelper;

class CategoryController extends AdminController
{
    public function category(Request $request)
    {
        $categoryList = Category::getCategoryView(4);
        return view('admin.category.category', compact('categoryList'));
    }

    public function newCategory(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:category',
            ]);
            if ($validator->fails()) {
                // fail : $validator->errors()
                return redirect()->route('admin.new_category')
                                ->withErrors($validator)
                                ->withInput();
            } else {
                // success
                $inputs = [
                    'name' => $data['name'],
                    'parent_id' => $data['parent_id'],
                    'slug' => MainHelper::getSlug($data['name']),
                ];
                Category::insert($inputs);
            }

        }

        $categoryList = Category::getCategoryView();

        return view('admin.category.new_category', compact('categoryList'));
    }

    public function editCategory(Request $request, $id)
    {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.edit_category',$id)
                                ->withErrors($validator)
                                ->withInput();
            } else {
                // success
                $data = [
                    'name' => $request->name,
                    'parent_id' => $request->parent_id,
                ];

                Category::where('id',$id)->update($data);
            }

        }

        $categoryList = Category::getCategoryView(4);
        $category = Category::find($id);

        return view('admin.category.edit_category', compact('category', 'categoryList'));
    }

    public function deleteCategory(Request $request)
    {
        return view('admin.category.category');
    }
}
