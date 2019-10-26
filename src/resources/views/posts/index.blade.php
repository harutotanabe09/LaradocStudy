@extends('layouts.default')

{{--
@section('title')
Blog Posts
@endsection
--}}

@section('title', 'Blog Posts')

@section('content')
<h1>Blog Posts</h1>
<a href="{{ url('/posts/create') }}" class="header-menu">New Post</a>
<ul>
  @forelse ($posts as $post)
  <li><a href="{{ action('PostsController@show', $post) }}">{{ $post->title }}</a></li>
  <li><a class="edit" href="{{ action('PostsController@edit', $post) }}">[Edit]</a></li>
  <li><a class="del" href="#" data-id="{{ $post->id }}">[x]</a></li>
 <form method="post" action="{{ url('/posts', $post->id) }}" id="form_{{ $post->id }}">
      {{ csrf_field() }}
      {{ method_field('delete') }}
 </form>
  @empty
  <li>No posts yet</li>
  @endforelse
</ul>
<script src="/js/main.js"></script>
@endsection