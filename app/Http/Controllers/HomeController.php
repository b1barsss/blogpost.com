<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
//        dd(Auth::user());
//        dd(Auth::id());
//        dd(Auth::check());
        return view('home');
    }

    public function contact()
    {
        return view('contact');
    }

    public function blogPost($id, $welcome)
    {
        $pages = [
            1 => [
                'title' => "page 1"
            ],
            2 => [
                'title' => "page 2"
            ],
        ];
        $welcomes = [
            1 => '<b>Hello</b> from ',
            2 => "Welcome to ",
        ];
        return view('blog-post', [
            'data' => $pages[$id],
            'welcome' => $welcomes[$welcome]
        ]);
    }
}
