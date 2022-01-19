<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class ApiCartController extends Controller
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
        $cartData = new Cart();
        $cartData->user_id = $request->user_id;
        $cartData->product_id = $request->product_id;
        $cartData->quantity = $request->quantity;
        if ($cartData->save()) {
            return response(['cartData' => $cartData, 'err' => 0, 'message' => "success"], 200);
        } else {
            return response(['cartData' => $cartData, 'err' => 1, 'message' => "error"], 200);
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
        $cartData = Cart::where('user_id', $id)->get();
        return response(['cartData' => $cartData, 'err' => 0, 'message' => "success"], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cartData = Cart::where('id', $id)->get();
        return response(['cartData' => $cartData, 'err' => 0, 'message' => "success"], 200);
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
        $cartData = Cart::where('id', $id)->update([
            'quantity' => $request->quantity,
        ]);
        if ($cartData) {
            return response(['cartData' => $cartData, 'err' => 0, 'message' => "success"], 200);
        } else {
            return response(['cartData' => $cartData, 'err' => 1, 'message' => "error"], 200);
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
        $cartData = Cart::where('id', $id)->first();
        if ($cartData->delete()) {
            return response(['cartData' => $cartData, 'err' => 0, 'message' => "success"], 200);
        } else {
            return response(['cartData' => $cartData, 'err' => 1, 'message' => "error"], 200);
        }
    }
}
