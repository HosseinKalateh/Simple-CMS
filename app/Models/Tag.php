<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    //relation with post
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
