<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Notifications\TowFactorCode;
use \Illuminate\Notifications\Notifiable    ;
use Illuminate\Http\Request;

class TowFactor extends Controller
{
    
    public function forgetPassword(Request $request)
    {
        $client = Client::where('email',$request->email)->first();
        if($client){
            $client->generateCode();
            $client->notify(new TowFactorCode());
            return response(['OTP' => $client->code],201);
        }else{
            return response(['msg'=>'The email is incorrect'],401);
            
        }

    }

    public function UpdatePasswordByOtp(Request $request)
    {
        $client = Client::where('code',$request->code)->first();
        if($client && ($client->expire_at) > now() ){
            $client->password = bcrypt($request->password);
            $client->destoryCode();
            $client->save();
            return response(['msg'=>'Update successfully'],201);
        }else{
            return response(['msg'=>'OTP is incorrect'],401);
            
        }

    }

}
