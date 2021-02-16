<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryPerson extends Model
{
    protected $table='delivery_people';

    protected $fillable=['user_id','join_date','tracking_id'];

     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
