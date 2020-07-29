<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    //relation with post
    public function posts()
    {
        return $this->hasMany(Post::class)->orderByDesc('id');
    }
}
