<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couponData = Coupon::orderBy('id', 'DESC')->paginate(10);
        return view('content.CouponManagement.coupon', ['couponData' => $couponData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.CouponManagement.addCoupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'code' => 'required|unique:coupons',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric'
        ]);
        if ($validate) {
            $coupon = new Coupon();
            $coupon->code = $request->code;
            $coupon->type = $request->type;
            $coupon->value = $request->value;
            $coupon->cart_value = $request->cart_value;
            if ($coupon->save()) {
                return redirect('coupon')->with('successCoupon', 'Coupon Added');
            } else {
                return redirect('coupon')->with('errorCoupon', 'Coupon Not Added');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::where('id', $id)->first();
        return view('content.CouponManagement.editCoupon', ['coupon' => $coupon]);
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
        $validate = $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric'
        ]);
        if ($validate) {
            $update = Coupon::where('id', $id)->update([
                'code' => $request->code,
                'type' => $request->type,
                'value' => $request->value,
                'cart_value' => $request->cart_value,
            ]);
            if ($update) {
                return redirect('coupon')->with('successCouponUpdate', 'Coupon Updated');
            } else {
                return redirect('coupon')->with('errorCouponUpdate', 'Coupon Not Updated');
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
        $coupon = Coupon::find($id);
        if ($coupon->delete()) {
            return back()->with('successDeleteCoupon', 'Coupon Deleted');
        } else {
            return back()->with('errorDeleteCoupon', 'Coupon Not Deleted');
        }
    }
}
