<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PageController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('guest.welcome', compact('posts'));
    }
}
