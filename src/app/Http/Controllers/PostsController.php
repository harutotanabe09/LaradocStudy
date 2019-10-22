<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    //
    public function index(){

        // use 使う前
        // $post = \App\Post::all();
        // use 使うあと
        // $post = Post::all();
        $post = Post::latest()->get(); // = $post = Post::orderBy('created_at', 'desc')->get();

        // dump / die
        dd($post->toArray());
        // return "hello";
        // viewを指定する
        return view('posts.index');
    }
}
