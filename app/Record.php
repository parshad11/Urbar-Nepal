<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable=['supplier_id','date','location','item','quantity'];
}
