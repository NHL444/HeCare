<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Social;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function logGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(){
        $cus = Socialite::driver('google')->user();
        $logcus = $this->loginbyGoogle($cus,'google');
       
        $acc_name = Customer::where('cus_id', $logcus->social_cus)->first();
        Session::put('cus_id',$acc_name->cus_id);
        Session::put('cus_name',$acc_name->cus_name);

        return Redirect::to('/checkout/checkform');
    }
    public function loginbyGoogle($cus,$provider){
        $logcus = Social::where('social_user_id',$cus->id)->first();
        if($logcus){
            return $logcus;
        }else
            $cus_new = new Social([
                'social_user_id' => $cus->id,
                'social_email' => $cus->email,
                'social_name' => strtoupper($provider)
            ]);
            $customer = Customer::where('cus_email',$cus->email)->first();
            if(!$customer){

                $customer =Customer::create([
                    'cus_name' => $cus->name,
                    'cus_email' => $cus->email,
                    'cus_password' =>'',
                    'cus_phone' => ''
                ]);
            }
            $cus_new->customer()->associate($customer);

            $cus_new->save();
            $acc_name = Customer::where('cus_id', $logcus->social_cus)->first();
            Session::put('cus_id',$acc_name->cus_id);
            Session::put('cus_name',$acc_name->cus_name);
            return redirect()->route('shop.checkform');

    }
}
