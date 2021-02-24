<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'summary', 'service_image', 'status', 'added_by'
    ];
}
