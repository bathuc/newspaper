<?php
use App\Http\Middleware\CheckRole;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', 'TestController@test')->name('front');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', function () { return redirect()->route('admin.login'); });
    Route::match(['get', 'post'], '/login', 'AdminController@login')->name('admin.login');
    Route::match(['get', 'post'], '/logout', 'AdminController@logout')->name('admin.logout');
    Route::match(['get', 'post'], '/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::match(['get', 'post'], '/role', 'AdminController@checkRole')->name('admin.role')->middleware(CheckRole::class);
    Route::match(['get', 'post'], '/register', 'AdminController@register')->name('admin.register');
    Route::get('/register/thanks', 'AdminController@registerThanks')->name('admin.register_thanks');
    Route::get('/activate/{token}', 'AdminController@activateUser')->name('admin.activate');
    Route::match(['get', 'post'], '/reset-password', 'AdminController@resetPassword')->name('admin.reset_password');

    Route::match(['get', 'post'], '/post', 'PostController@post')->name('admin.post');
    Route::match(['get', 'post'], '/post/new', 'PostController@newPost')->name('admin.new_post');
    Route::match(['get', 'post'], '/post/edit/{id}', 'PostController@editPost')->name('admin.edit_post');
    Route::post('/post/delete/{id}', 'PostController@deletePost')->name('admin.delete_post');

    Route::match(['get', 'post'], '/category', 'CategoryController@category')->name('admin.category');
    Route::match(['get', 'post'], '/category/new', 'CategoryController@newCategory')->name('admin.new_category');
    Route::match(['get', 'post'], '/category/edit/{id}', 'CategoryController@editCategory')->name('admin.edit_category');
    Route::post('/category/active/{id}', 'CategoryController@activeCategory')->name('admin.active_category');
    Route::match(['get', 'post'], '/category/swap-order', 'CategoryController@swapCategoryOrder')->name('admin.category_swap_order');
    Route::match(['get', 'post'], '/category/friend-list/{id}', 'CategoryController@getCategoryFriendList')->name('admin.category_friend_list');
    Route::post('/category/delete/{id}', 'CategoryController@deleteCategory')->name('admin.delete_category');

});

Route::group(['prefix' => '', 'namespace' => 'Front'], function () {
    Route::match(['get', 'post'], '/', 'HomeController@index')->name('front.index');
    Route::match(['get', 'post'], '/{slug}', 'HomeController@routeName')->name('front.route_name');

});