<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable =[
        'file_type', 'file_name'
    ];
}
