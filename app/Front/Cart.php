<?php

namespace App\Front;

use App\Variation;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guard = 'customer';

    protected $fillable = [
        'product_id', 'user_id', 'quantity', 'total_price'
    ];

    public function variation(){
        return $this->belongsTo(Variation::class,'product_id','id');
    }
}
