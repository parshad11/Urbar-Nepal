<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [
          ];
    public function category(){
        return $this->hasOne(BlogCategory::class, 'id', 'category_id');
    }
}
