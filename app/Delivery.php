<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Delivery extends Model
{
    use Notifiable;



    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'deliveries';

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id');
    }

   



    
}
