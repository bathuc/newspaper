<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
        $categoryList = Category::orderBy('order')->get();
        $category = $categoryList->groupBy('parent_id')->toArray();
        echo "<pre>";
        print_r($category);
        echo "<pre>";
        die();
        return view('test');
    }


}
