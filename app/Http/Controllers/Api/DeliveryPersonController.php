<?php

namespace App\Http\Controllers\Api;

use App\User;
use FontLib\Table\Type\loca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryPerson;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Auth;

class DeliveryPersonController extends Controller
{

	public function GetAllDeliveryPeople()
	{
		$delivery_person = User::where('id', Auth::user()->id)->get();
		return response()->json([
			'data' => $delivery_person
		]);
	}

	public function getLocation($id)
	{
		$delivery_person=DeliveryPerson::find($id);
		$latitude = $delivery_person->latitude;
		$longitude = $delivery_person->longitude;
		$location = [
			'latitude' => $latitude,
			'longitude' => $longitude
		];
		return response()->json([
			'data' => $location
		]);
	}

	public function updateLocation(Request $request){
		$user_id = Auth::user()->id;
		$delivery_person=DeliveryPerson::where('user_id',$user_id)->first();
		DeliveryPerson::where('user_id',$user_id)->update([
			'latitude'=>$request->latitude,
			'longitude'=>$request->longitude
		]);
		$delivery_person=DeliveryPerson::where('user_id',$user_id)->first();
		return response()->json([
			'data' => $delivery_person
		]);
	}
}
