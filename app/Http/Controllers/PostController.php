<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public  function __construct()
    {
        $this->middleware('auth')
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
//        DB::connection()->enableQueryLog();
//
//        $posts = BlogPost::with('comment')->get();
//
//        foreach ($posts as $post)
//        {
//            foreach ($post->comment as $comment)
//            {
////                echo $comment->content;
//            }
//        }
//
//        dd(DB::getQueryLog());
        return view(
            "posts.index",
            ["posts" => BlogPost::withCount('comments')->get()]); // comments_count column added
    }

    public function show(Request $request, $id) //There are another way how to write this method
    {

//        $request->session()->reflash();
        return view('posts.show', [
            "post" => BlogPost::with('comments')->findOrFail($id)
        ]);
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
//        $post = BlogPost::findOrFail($id);
//        $post->delete();
        Comment::destroy(BlogPost::findOrFail($id)->comments);
        BlogPost::destroy($id);

        $request->session()->flash("status", 'Blog post was Deleted!!!');
        return redirect()->route('posts.index');
    }

}
