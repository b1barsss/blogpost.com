<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
//use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redis;
//use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public  function __construct()
    {
        $this->middleware('auth')
        ->only(['create', 'store', 'edit', 'update', 'destroy', 'restore']);
    }

    public function index()
    {

        return view("posts.index",[
            "posts" => BlogPost::latest()->withCount('comments')->with(['user','tags'])->get(),
        ]);
    }

    public function show(Request $request, $id) //There are another way how to write this method
    {

        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-$id", 60, function () use ($id)
        {
            return BlogPost::with(['comments' ,'tags'])->findOrFail($id);
        });
        $sessionId = session()->getId();
        $counterKey = "blog-post-$id-counter";
        $usersKey = "blog-post-$id-users";

        $users = Cache::tags(['blog-post'])->get($usersKey,[]);
        $usersUpdate = [];
        $difference = 0;
        $now = now();



        foreach ($users as $session => $lastVisit)
        {
            if ($now->diffInMinutes($lastVisit) >= 1)
            {
                $difference--;
            } else
            {
                $usersUpdate[$session] = $lastVisit;
            }
        }
        if (
            !array_key_exists($sessionId, $users)
            || $now->diffInMinutes($users[$sessionId]) >= 1
        ){
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::tags(['blog-post'])->forever($usersKey, $usersUpdate);

        if (Cache::tags(['blog-post'])->has($counterKey))
        {
            Cache::tags(['blog-post'])->increment($counterKey, $difference);
        }else {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
//            dd(Cache::tags(['blog-post'])->get($counterKey));
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);

        return view('posts.show', [
            "post" => $blogPost,
            "counter" => $counter,
        ]);
//        $request->session()->reflash();
//        return view('posts.show', [
//            "post" => BlogPost::latestt()->with(['comments' => function ($query)
//            {return $query->latestt();}])->findOrFail($id)
//        ]);
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
        $validatedData['user_id'] = $request->user()->id;

        $blogPost = BlogPost::create($validatedData);

        $request->session()->flash('status','Blog post was created successfully!');
        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        return view("posts.edit", ['post' => $post]);

//        $this->authorize('update',$post);
//        if (Gate::denies('update-post', $post))
//        {
//            abort(403,"You can't edit this blog post!");
//        }
    }

    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $validatedData = $request->validated();
        $post->fill($validatedData)->save();
        $request->session()->flash("status", 'Blog post was Updated!!!');
        return redirect()->route('posts.show', ['post' => $post->id]);

//        if (Gate::denies('update-post',$post))
//        {
//            abort(403,"You can't edit this blog post!");
//        }
//        Gate::authorize('update', $post);

    }

    public function restore(Request $request, $id)
    {
        BlogPost::findOrFail($id)->restore();

        $request->session()->flash("status", 'Blog post was restored!!!');
        return redirect()->route('posts.index');
    }

    public function destroy(Request $request, $id)
    {
        BlogPost::findOrFail($id)->delete();

        $request->session()->flash("status", 'Blog post was Deleted!!!');
        return redirect()->route('posts.index');
//        if (Gate::denies('delete-post', $post))
//        {
//            abort(403,"You can't delete this blog post!");
//        }
//        $this->authorize('delete', $post);

//        BlogPost::destroy($id);
    }

}
