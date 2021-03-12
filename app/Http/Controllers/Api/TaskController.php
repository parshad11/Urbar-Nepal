<?php

namespace App\Http\Controllers\Api;

use App\Delivery;
use App\DeliveryPerson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use Auth;

class TaskController extends Controller
{
    public function index(){
	    if (!auth()->user()->can('task.view') && !auth()->user()->can('view_own_task')) {
		    abort(403, 'Unauthorized action.');
	    }
	    if(auth()->user()->user_type=='delivery' || auth()->user()->user_type=='Delivery')
	    {
		    $delivery_person = DeliveryPerson::where('user_id', auth()->user()->id)->first();
		    $task = Task::where('delivery_person_id', $delivery_person->id)->get();
	    }
	    elseif(auth()->user()->user_type=='admin' || auth()->user()->user_type=='Admin'){
		    $task = Task::all();
	    }
	    return response()->json([
		    'data'=>$task
	    ]);
    }
}
