<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index() {
      // useを使わない
      // $posts = \App\Post::all();
      // 全件取得
      // $posts = Post::all();
      // Orderbyを使った方法
      // $posts = Post::orderBy('created_at', 'desc')->get();
      $posts = Post::latest()->get();
      // $posts = [];
      // Dumpの設定
      // dd($posts->toArray()); // dump die
      // return view('posts.index', ['posts' => $posts]);
      return view('posts.index')->with('posts', $posts);
    }

    // public function show($id) {
    public function show(Post $post) {
        // dd($post->toArray()); // dump die
        // idを指定して検索する方法
        // $post = Post::find($id);
        // $post = Post::findOrFail($id);
        return view('posts.show')->with('post', $post);
    }
}