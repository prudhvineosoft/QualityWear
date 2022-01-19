<?php

namespace App\Http\Controllers;

use App\Models\OrderManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApiOrderController extends Controller
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
        $userdata = User::where('email', $request->user_id)->first();
        // return response($userdata->id);
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'order_id' => 'required',
            'product_id' => 'required',
            'payment_method' => 'required',
            'address_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'validation error', 'err' => 1], 200);
        } else {
            $order = new OrderManagement();
            $order->user_id = $userdata->id;
            $order->order_id = $request->order_id;
            $order->product_id = $request->product_id;
            $order->payment_method = $request->payment_method;
            $order->address_id = $request->address_id;
            $order->coupon_code = $request->coupon_code;
            $order->order_total = $request->order_total;
            if ($order->save()) {
                return response(['order' => $order, 'message' => 'order create successfully', 'err' => 0], 200);
            } else {
                return response(['msg' => 'order not added', 'err' => 1], 200);
            }

            $email = $request->user_id;
            $data = $request->all();
            $data = ['name' => 'Quality Wear', 'data' => $data];
            $user['to'] = $email;
            Mail::send('content.Extras.mail', $data, function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->to('prudhvi.inumarthi@gmail.com');
                $messages->subject('Order Placed');
            });
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
        $orderData = OrderManagement::where('user_id', $id)->orderBy('id', 'DESC');
        return response(['orderData' => $orderData, 'err' => 0, 'msg' => 'success banner data'], 200);
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
