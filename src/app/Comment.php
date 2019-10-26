<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['body'];

    // $comment->post
    // 紐付けを定義
    public function post() {
      return $this->belongsTo('App\Post');
    }
}
