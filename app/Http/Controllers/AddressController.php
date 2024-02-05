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

    public function CreateAddress(Request $request){
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
        $address= new Address();
        $address->client_id = $request->user()->id;
        $address->city = $request->city;
        $address->type = $request->type;
        $address->area = $request->area;
        $address->buliding = $request->buliding;
        $address->appartment = $request->appartment;
        $address->floor = $request->floor;
        $address->street = $request->street;
        $address->additional_directions = $request->additional_directions;

        if ($address->save()) {
            return response ($address,201);
        }else {
            return response ('something went wrong',401);
        }
}

public function updateAddress(UpdateAddressRequest $request, $id)
{
    $address =Address::find($id)->update($request->validated());
    return response([ 'message' => 'Updated successfully',], 200);

}

public function DeleteAddress(Request $request)
{
    Address::find($request->id)->Destroy();
    return response([ 'message' => 'Deleted successfully',], 200);

}
}
