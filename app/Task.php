<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=['assign_to','task_type','title','description','special_instruction','start_loc','end_loc',
        'start_date','end_date','status'];

    public function task_assign($task){
        $user = User::findOrFail($task);
        $name = $user->surname.'.'.$user->first_name.' '.$user->last_name;
        return $name;
    }
}
