<?php

namespace App\Http\Controllers\Api;

use FontLib\Table\Type\loca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryPerson;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class DeliveryPersonController extends Controller
{

	public function GetAllDeliveryPeople(){
        $delivery_person=DeliveryPerson::all();
        return response()->json([
            'data'=>$delivery_person
        ]);
    }

    public function getLocation(){

	    $latitude=27.68519336;
	    $longitude=85.34866242;
	    $location=[
		    'latitude'=>$latitude,
		    'longitude'=>$longitude
	    ];
	    return response()->json([
		    'data'=>$location
	    ]);
    }

    public function getDeliveryPersonLocation(Request $request,$id){

//    	$client=new Client([
//		    'base_uri' => 'http://freshktm.loc/',
//		    ]);
//    	$res=$client->get('api/delivery/location',[
//		    'verify' => true,
//    		'form_params'=>[
//    			'id'=>$id
//		    ]
//	    ]);

//	    $res=Http::get('http://freshktm.loc/api/delivery/location');
//		dd($res);
//    	$result=$res->getBody();
//    	dd($result);
	    $ip = request()->ip();
	    $data = \Location::get($ip);
	    return $data;
    }
}
