<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data=$request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['username', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
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
            'user' => [
                'id' => $user->id,
                'type' => $user->user_type,
                'surname' => $user->surname,
                'First name' => $user->first_name,
                'last name' => $user->first_name,
                'username' => $user->username,
                'email' => $user->email,
                'user_type' => $user->user_type,
                'language' => $user->language,
                'contact no' => $user->contact_no,
                'address' => $user->address,
                'business id' => $user->business_id,
                'max sales discount percent' => $user->max_sales_discount_percent,
                'allow login' => $user->allow_login,
                'status' => $user->status,
                'is commission agent' => $user->is_commsn_agent,
                'commission percent' => $user->cmmsn_percent,
                'selected contacts' => $user->selected_contacts,
                'dob' => $user->dob,
                'gender' => $user->gender,
                'marital status' => $user->maritial_status,
                'bloog group' => $user->blood_group,
                'contact number' => $user->contect_number,
                'fb link' => $user->fb_link,
                'twitter link' => $user->twitter_link,
                'socail_media_1' => $user->social_media_1,
                'socail_media_2' => $user->social_media_2,
                'permanent address' => $user->permanent_address,
                'current address' => $user->current_address,
                'guardian name' => $user->guardian_name,
                'costom field 1' => $user->costom_field_1,
                'costom field 2' => $user->costom_field_2,
                'costom field 3' => $user->costom_field_3,
                'costom field 4' => $user->costom_field_4,
                'bank detail'=> $user->bank_details,
                'id proof name'=>$user->id_proof_name,
                'id proof number'=>$user->id_proof_number,
                ]
        ]);

    }
}
