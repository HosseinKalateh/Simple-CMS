<?php

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
/*
 * Note: this routes name start with "front."
 */

// Index page (all posts)
Route::get('/', 'PostController@index');

// Index page (all posts)
Route::get('/posts', 'PostController@index')->name('post.index');

// Show post
Route::get('/posts/{id}', 'PostController@show')->name('post.show');

// Show category posts
Route::get('/posts/categories/{id}', 'PostController@categoryPosts')->name('post.category-post');

// Show tag posts
Route::get('/posts/tags/{id}', 'PostController@tagPosts')->name('post.tag-posts');
