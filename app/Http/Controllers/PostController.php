<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view("posts.index",["posts" => BlogPost::all()]);
    }

    public function show(Request $request, $id) //There are another way how to write this method
    {

//        $request->session()->reflash();
        return view('posts.show', ["post" => BlogPost::findOrFail($id)]);
    }

//    public function show(Request $request, BlogPost $post)
//    {
//        $request->session()->reflash();
//        return view('posts.show', ["post" => $post]);
//    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePost $request)
    {
        $validatedData = $request->validated();

        $blogPost = BlogPost::create($validatedData);
        $request->session()->flash('status','Blog post was created successfully!');

        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view("posts.edit", ['post' => $post]);
    }

    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validatedData = $request->validated();

        $post->fill($validatedData)->save();

        $request->session()->flash("status", 'Blog post was Updated!!!');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }
    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();
//        BlogPost::destroy($id);

        $request->session()->flash("status", 'Blog post was Deleted!!!');
        return redirect()->route('posts.index');
    }

}
