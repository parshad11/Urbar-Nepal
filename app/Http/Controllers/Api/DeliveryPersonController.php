<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryPerson;

class DeliveryPersonController extends Controller
{
    public function GetAllDeliveryPeople(){
        $delivery_person=DeliveryPerson::all();
        return response()->json([
            'data'=>$delivery_person
        ]);
    }

    public function getDeliveryPersonLocation($delivery_person_id){
        
    }
}
