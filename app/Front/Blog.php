<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'category_id', 'summary', 'description', 'image', 'added_by', 'status'
    ];
    public function category(){
        return $this->hasOne(BlogCategory::class, 'id', 'category_id');
    }
}
