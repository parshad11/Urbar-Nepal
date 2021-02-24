<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name', 'post', 'social_links', 'added_by', 'member_image', 'status'
    ];
}
