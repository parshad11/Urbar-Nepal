<?php

namespace App\Http\Controllers\Api;

use FontLib\Table\Type\loca;
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

    public function getDeliveryPersonLocation(Request $request,$id){
        if($request->ajax()){
			$latitude=27.68519335;
			$longitude=85.34866242;
			$location=[
				'latitude'=>$latitude,
				'longitude'=>$longitude
			];
	        return $location;
        }
    }
}
