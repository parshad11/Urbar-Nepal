<?php

namespace App\Http\Middleware;

use App\Business;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Utils\BusinessUtil;

class SetCustomerSessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('user')) {
            $business_util = new BusinessUtil;

            $user = Auth::guard('customer')->user();
            $session_data = ['id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'business_id' => $user->business_id,
                            ];
            $business = Business::findOrFail($user->business_id);
            
            $currency = $business->currency;
            $currency_data = ['id' => $currency->id,
                                'code' => $currency->code,
                                'symbol' => $currency->symbol,
                                'thousand_separator' => $currency->thousand_separator,
                                'decimal_separator' => $currency->decimal_separator
                            ];

            $request->session()->put('user', $session_data);
            $request->session()->put('business', $business);
            $request->session()->put('currency', $currency_data);

            //set current financial year to session
            $financial_year = $business_util->getCurrentFinancialYear($business->id);
            $request->session()->put('financial_year', $financial_year);
        }

        return $next($request);
    }
}
