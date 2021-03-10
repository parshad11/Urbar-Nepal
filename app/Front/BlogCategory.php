<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = ['title', 'slug', 'added_by'];

    public function news(){
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }
}
