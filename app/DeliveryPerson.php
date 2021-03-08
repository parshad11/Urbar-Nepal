<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DeliveryPerson extends Model
{
    use Notifiable;
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
