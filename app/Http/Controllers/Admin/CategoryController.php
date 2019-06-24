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
        $categoryList = Category::getCategoryView();
        return view('admin.category.category', compact('categoryList'));
    }

    public function newCategory(Request $request)
    {
        $alert = ''; $message = '';
        if($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:category',
            ]);
            if ($validator->fails()) {
                $alert = 'error'; $message = 'Category create fail';
            } else {
                // success
                $inputs = [
                    'name' => $data['name'],
                    'parent_id' => $data['parent_id'],
                    'slug' => MainHelper::getSlug($data['name']),
                    'order'=> 0
                ];
                $categoryId = Category::insertGetId($inputs);
                $updateOrder = [
                    'order'=> $categoryId,
                ];

                Category::where('id',$categoryId)->update($updateOrder);
                $alert = 'success'; $message = 'Category create successful!';
            }

        }

        $categoryList = Category::getCategoryView();
        $level = Category::getLevel();

        return view('admin.category.new_category', compact('categoryList', 'level', 'alert', 'message'));
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

        $categoryList = Category::getCategoryView();
        $category = Category::find($id);
        $level = Category::getLevel();

        return view('admin.category.edit_category', compact('category', 'categoryList', 'level'));
    }

    public function swapCategoryOrder(Request $request)
    {
        $alert = ''; $message = '';

        if($request->isMethod('post')) {
            $data = $request->all();
            $fromId = $data['from_id'];
            $toId = $data['to_id'];

            if($fromId == $toId) {
                $alert = 'error'; $message = 'Please chose diffrent category';
            }
            else{
                Category::swapOrder($fromId, $toId);
                $alert = 'success'; $message = 'Swap category order successful!';
            }
        }

        $categoryList = Category::getCategoryView();
        $level = Category::getLevel();

        return view('admin.category.category_swap', compact('categoryList', 'level', 'firstFriendList', 'alert', 'message'));
    }

    public function deleteCategory(Request $request)
    {
        return view('admin.category.category');
    }
}
