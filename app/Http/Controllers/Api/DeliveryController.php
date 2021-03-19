<?php

namespace App\Http\Controllers\Api;

use App\Transaction;
use Illuminate\Http\Request;
use App\Delivery;
use App\DeliveryPerson;
use App\Http\Controllers\Controller;
use Auth;


class DeliveryController extends Controller
{
    public function index(){

        if (!auth()->user()->can('delivery.view') && !auth()->user()->can('view_own_delivery')) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->user_type=='delivery' || auth()->user()->user_type=='Delivery')
        {
            $delivery_person = DeliveryPerson::where('user_id', auth()->user()->id)->first();
            $delivery = Delivery::with('transaction')->where('delivery_person_id', $delivery_person->id)->get();
        }
        elseif(auth()->user()->user_type=='admin' || auth()->user()->user_type=='Admin'){
            $delivery = Delivery::with('transaction')->get();
        }

        return response()->json([
            'data'=>$delivery
        ]);
    }

    public function update(Request $request,$id){
        $data=$request->all();
        $delivery=Delivery::findorfail($id);
	    $transaction=Transaction::findorFail($delivery->transaction_id);
	    if($request->delivery_status=='packed'){
		    $data['delivery_started_at']=null;
		    $data['delivery_ended_at']=null;
		    if($transaction->type=='sell_transfer'){
			    $transaction->status='pending';
			    $transaction->save();
		    }
		    else if($transaction->type=='purchase'){
			    $transaction->status='pending';
			    $transaction->save();
		    }
	    }
        if($request->delivery_status=='Shipped' || $request->delivery_status=='shipped'){
            $data['delivery_started_at']=date('Y-m-d h:i:s');
	        if($transaction->type=='sell_transfer'){
		        $transaction->status='transit';
		        $transaction->save();
	        }
	        else if($transaction->type=='purchase'){
		        $transaction->status='pending';
		        $transaction->save();
	        }
        }
        if($request->delivery_status=='Delivered' || $request->delivery_status=='delivered'){
            $data['delivery_ended_at']=date('Y-m-d h:i:s');
	        if($transaction->type=='sell_transfer'){
		        $transaction->status='completed';
		        $transaction->save();
	        }
	        else if($transaction->type=='purchase'){
		        $transaction->status='received';
		        $transaction->save();
	        }
        }
        if($request->delivery_status=='Cancelled' || $request->delivery_status=='cancelled'){
            $data['delivery_started_at']=null;
            $data['delivery_ended_at']=null;
        }

        $delivery->fill($data);
        $success=$delivery->save();
		$delivery=Delivery::where('id',$id)->get();
        return response()->json([
            'data'=>$delivery
        ]);
    }

    
}




