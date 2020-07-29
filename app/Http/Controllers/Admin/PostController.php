<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\post\StorePost;
use App\Http\Requests\post\UpdatePost;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\True_;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('admin.post.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags  = Tag::latest()->get();
        $categories = Category::latest()->get();

        return view('admin.post.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $inputs = array();
        $inputs['title'] = $request->input('title');
        $inputs['description'] = $request->input('description');
        $inputs['content'] = $request->input('content');
        $inputs['category_id'] = $request->input('category_id');

        //save post image
        if ($request->hasFile('image')) {
            $originalImage = $request->file('image');
            $thumbnailPath = storage_path('app/public/posts/');
            $thumbnailName = time().'_'.$originalImage->getClientOriginalName();
            $thumbnailImage = Image::make($originalImage)->resize(960,640)->save($thumbnailPath.$thumbnailName);
//            Storage::put('public/posts/'.$thumbnailName, $thumbnailImage);
            $inputs['image'] = "/storage/posts/".$thumbnailName;
        }
        //save post
        $post = Post::create($inputs);

        //save post tags
        $post->tags()->attach($request->input('tags_id'));

        //redirect
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags  = Tag::latest()->get();
        $categories = Category::latest()->get();

        $postTags = array();
        foreach ($post->tags()->get(['id']) as $tag) {
            $postTags[] = $tag->id;
        }

        return view('admin.post.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePost $request, Post $post)
    {
        $inputs = array();
        $inputs['title'] = $request->input('title');
        $inputs['description'] = $request->input('description');
        $inputs['content'] = $request->input('content');
        $inputs['category_id'] = $request->input('category_id');

        //save post image
        if ($request->hasFile('image')) {
            //delete post last image
            unlink(public_path($post->image));

            $originalImage = $request->file('image');
            $thumbnailPath = storage_path('app/public/posts/');
            $thumbnailName = time().'_'.$originalImage->getClientOriginalName();
            $thumbnailImage = Image::make($originalImage)->resize(960,640)->save($thumbnailPath.$thumbnailName);
            $inputs['image'] = "/storage/posts/".$thumbnailName;
        }
        //update post
        $post->update($inputs);

        //update post tags
        $post->tags()->sync($request->input('tags_id'));

        //redirect
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //delete post image
        unlink(public_path($post->image));

        $post->delete();

        return true;
    }
}
