<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'description', 'image', 'added_by', 'status'
    ];
}
