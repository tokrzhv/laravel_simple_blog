<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(3);
        $posts->withPath('/posts');
        return view('main.index', compact('posts'));
    }
}
