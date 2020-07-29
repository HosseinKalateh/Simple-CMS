<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with(['category', 'tags'])->latest()->simplePaginate(1);
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        return view('front.index', get_defined_vars());
    }

    /**
     * Display a listing of the resource by category
     *
     * @return \Illuminate\Http\Response
     */

    public function categoryPosts($id)
    {
        $category = Category::findOrFail($id);
        $posts = $category->posts()->latest()->simplePaginate(1);

        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        return view('front.index', get_defined_vars());
    }

    /**
     * Display a listing of the resource by tag
     *
     * @return \Illuminate\Http\Response
     */

    public function tagPosts($id)
    {
        $tag = Tag::findOrFail($id);
        $posts = $tag->posts()->latest()->simplePaginate(1);

        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        return view('front.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('front.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
