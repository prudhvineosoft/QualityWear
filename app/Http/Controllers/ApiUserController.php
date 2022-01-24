<?php

namespace App\Http\Controllers;

use App\Models\OrderManagement;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $udUser = User::where('email', $id)->first();
        // $udStatus = UserStatus::where('user_id', $udUser->id)->first();
        // $udAddress = UserAddress::where('user_id', $udUser->id)->get();
        // $orderData = OrderManagement::join('products', 'products.id', '=', 'order_management.product_id')->where('order_management.user_id', $udUser->id)->get();

        $allUserData = User::with('address', 'userStatus')->where('email', $id)->first();
        $orderData = OrderManagement::with('productDetails')->where('user_id', $allUserData->id)->get();
        return response(['allUserData' => $allUserData, 'orderData' => $orderData]);
        // return response(['udUser' => $udUser, 'udStatus' => $udStatus,  'udAddress' => $udAddress,  'orderData' => $orderData], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
