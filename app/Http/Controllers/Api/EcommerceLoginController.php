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
		$credentials = request(['email', 'password']);
		if (!Auth::guard('customer')->attempt($credentials)) {
			return response()->json(['message' => 'Unauthorized'], 401);
		}
		$user = $user = Auth::guard('customer')->user();
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
			'access_token' => $tokenResult->accessToken,
			'token_type' => 'Bearer',
			'expires_at' => Carbon::parse(
				$tokenResult->token->expires_at
			)->toDateTimeString(),
			'user' => $user
		]);
	}
}
