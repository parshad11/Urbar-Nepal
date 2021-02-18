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


    public function task_assign($task){
        $user = User::findOrFail($task);
        $name = $user->surname.'.'.$user->first_name.' '.$user->last_name;
        return $name;
    }

    public function location($id){
        $task=Task::findOrFail($id);
        $location = $task->start_lat.'/'.$task->start_log.'-'.$task->end_lat.'/'.$task->end_log;
        return $location;
    }

    public function date($id){
        $task=Task::findOrFail($id);
        $date = $task->start_date . '-' . $task->end_date;
        return $date;
    }

    
    

}
