<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded = [
        
    ];

    public function news(){
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }
}
