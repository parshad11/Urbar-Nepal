<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'image',  'status'
    ];
}
