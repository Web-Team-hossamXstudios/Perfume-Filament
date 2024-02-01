<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Models\Client;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function getAddress(){
        $address= Address::all()->where('client_id',auth()->user()->id);
        
        return response(['address' => $address],200);
    }

    public function storeAddress(Request $request){
        $request->validate([
            "city"=>"required",
            "type"=>"required",
            "area"=>"required",
            "buliding"=>"required",
            "appartment"=>"required",
            "floor"=>"required",
            "street"=>"required",
            "additional_directions"=>"required",
        ]);
        $address=Address::create([
            "client_id"=>$request->user()->id,
            "city"=>$request->city,
            "type"=>$request->type,
            "area"=>$request->area,
            "buliding"=>$request->buliding,
            "appartment"=>$request->appartment,
            "floor"=>$request->floor,
            "street"=>$request->street,
            "additional_directions"=>$request->additional_directions,
        ]);
        return response([$address], 201);
}

public function updateAddress(Request $request)
{
    $address=Address::find($request->id );
    $address->update();

    return response([ 'message' => 'Updated successfully',], 200);

}
}
