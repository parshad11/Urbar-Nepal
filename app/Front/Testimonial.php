<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'post', 'comment', 'image', 'status', 'added_by'
    ];
}
