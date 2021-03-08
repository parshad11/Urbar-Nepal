<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    //
    protected $fillable = [
        'job_title', 'job_description', 'form_link', 'added_by', 'status'
    ];
}
