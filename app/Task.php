<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
      /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded=['id'];

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    public function delivery_person(){
        return $this->belongsTo(DeliveryPerson::class,'delivery_person_id');
    }

    public function record_staff()
    {
        return $this->belongsTo(\App\User::class, 'assigned_by');
    }

    public function location()
    {
        return $this->belongsTo(\App\BusinessLocation::class, 'location_id');
    }


    public function date($id){
        $task=Task::findOrFail($id);
        $date = $task->start_date . '-' . $task->end_date;
        return $date;
    }

    
    

}
