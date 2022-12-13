<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// ROTTE PUBBLICHE
Route::get('/', 'PageController@index')->name('homepage');
Route::get('/posts', 'PostController@index')->name('guest.posts.index');
Route::get('/posts/{slug}', 'PostController@show')->name('guest.posts.show');

// ROTTE AUTHENTICATION
Auth::routes();

// ROTTE AREA ADMIN
Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(
    function() {
        Route::get('/', 'AdminController@index')->name('home');
        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController');
    }
);
// SPECIFICARE MIDDLEWARE
// NAMESPACE CARTELLA ADMIN IN CONTROLLER
// PREFIX = LOCALHOST/ADMIN/HOME
// GROUP PER RAGGRUPPARE LE ROTTE
// NAME PER LE ROUTE