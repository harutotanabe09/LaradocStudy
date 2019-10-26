<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title' , 'body'];

    // 紐付けを定義
    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
