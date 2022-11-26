<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
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
            ]
        ];
        $welcomes = [
            1 => '<b>Hello</b> from ', 2 => "Welcome to "
        ];
        return view('blog-post', [
            'data' => $pages[$id],
            'welcome' => $welcomes[$welcome]
        ]);
    }
}
