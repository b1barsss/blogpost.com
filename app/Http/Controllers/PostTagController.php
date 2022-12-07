<?php

namespace App\Http\Controllers;


use App\Models\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function index($tag)
    {
//        $tags = Tag::with(['blogPosts.user', 'blogPosts.tags'])->findOrFail($tag);
//        return view('posts.index', [
//            'posts' => $tags->blogPosts,
//        ]);
        $tags = Tag::findOrFail($tag);
        return view('posts.index', [
            'posts' => $tags->blogPosts()
                ->latestWithRelations()
                ->get(),
        ]);
    }
}
