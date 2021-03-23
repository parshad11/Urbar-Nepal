<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Contact;

class EcommerceLoginController extends Controller
{
	public function login(Request $request)
	{
		$data = $request->validate([
			'email' => 'required|string',
			'password' => 'required|string',
			'remember_me' => 'boolean'
		]);
		$credentials = ['email'=>$request->email,'password'=>$request->password,'type'=>['customer','both']];
		if (!Auth::guard('customer')->attempt($credentials)) {
			return response()->json(['message' => 'Unauthorized'], 401);
		}
		$user = Auth::guard('customer')->user();
		$tokenResult = $user->createToken('Personal Access Token');
		return $this->loginSuccess($tokenResult, $user);
	}


	protected function loginSuccess($tokenResult, $user)
	{
		$token = $tokenResult->token;

		$token->expires_at = Carbon::now()->addWeeks(100);
		$token->save();
		return response()->json([
			'status' => 'ok',
//			'guard'=> Auth::guard('customer')->check(),
			'access_token' => $tokenResult->accessToken,
			'token_type' => 'Bearer',
			'expires_at' => Carbon::parse(
				$tokenResult->token->expires_at
			)->toDateTimeString(),
			'user' => $user
		]);
	}

	public function profile(){
		$user=Auth::guard('customerapi')->user();
		return response()->json([
			'user'=>[$user],
		]);
	}
}
