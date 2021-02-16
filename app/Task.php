<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=['assign_to','task_type','title','description','special_instruction','start_lat','start_log',
        'end_lat','end_log','start_date','end_date','status'];

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
