<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class FrontAbout extends Model
{
    protected $fillable= [
        'banner_image', 'what_sub_title', 'what_description', 'what_image', 'why_sub_title', 'why_description', 'why_short_points', 'why_image', 'added_by'
    ];
}
