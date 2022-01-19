<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiUserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return response($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'landmark' => 'required',
            'state' => 'required',
            'pin' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'validation error', 'err' => 1], 200);
        } else {
            $userAddress = new UserAddress();
            $userAddress->user_id = $request->user_id;
            $userAddress->name = $request->name;
            $userAddress->street = $request->street;
            $userAddress->city = $request->city;
            $userAddress->landmark = $request->landmark;
            $userAddress->state = $request->state;
            $userAddress->pin = $request->pin;
            $userAddress->phone = $request->phone;
            if ($userAddress->save()) {
                return response(['userAddress' => $userAddress, 'message' => 'address create successfully', 'err' => 0], 200);
            } else {
                return response(['msg' => 'Contact not added', 'err' => 1], 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $addrData = UserAddress::where('id', $id)->first();
        return response(['addrData' => $addrData, 'err' => 0, 'message' => 'seccess'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return response($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'landmark' => 'required',
            'state' => 'required',
            'pin' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'validation error', 'err' => 1], 200);
        } else {
            $userAddress = UserAddress::where('id', $id)->update([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'street' => $request->street,
                'city' => $request->city,
                'landmark' => $request->landmark,
                'state' => $request->state,
                'pin' => $request->pin,
                'phone' => $request->phone,
            ]);
            if ($userAddress) {
                return response(['userAddress' => $userAddress, 'message' => 'address updated successfully', 'err' => 0], 200);
            } else {
                return response(['msg' => 'Address not Updated', 'err' => 1], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addrDelete = UserAddress::find($id);
        if ($addrDelete->delete()) {
            return response(['err' => 0, 'message' => 'Address Deleted'], 200);
        } else {
            return response(['err' => 1, 'message' => 'Address Not Deleted'], 200);
        }
    }
}
