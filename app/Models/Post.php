<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = [
        'title', 'description', 'content', 'image', 'category_id'
    ];


    //relation with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relation with tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //Accessor
    public function getCreatedAtAttribute($value)
    {
        $dt = Carbon::make($value);

        return $dt->toFormattedDateString();
    }
}
