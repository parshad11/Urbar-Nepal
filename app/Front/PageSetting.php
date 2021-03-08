<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    //
    protected $fillable = [
        'title', 'slug', 'body', 'added_by', 'status'
    ];
}
