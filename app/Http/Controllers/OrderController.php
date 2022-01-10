<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderManagement;
use App\Models\Products;
use App\Models\ProductsImages;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserStatus;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderData = OrderManagement::orderBy('id', 'DESC')->paginate(10);
        return view('content.OrderManagement.orderManagement', ['orderData' => $orderData]);
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
        $order = OrderManagement::where('id', $id)->first();

        $product = Products::where('id', $order->product_id)->get();
        $productImages = ProductsImages::where('product_id', $product[0]->id)->get();
        $categories = Category::all();

        $udUser = User::where('id', $order->user_id)->get();
        $udStatus = UserStatus::where('user_id', $udUser[0]->id)->get();
        $udRole =  User::join('user_statuses', 'users.id', '=', 'user_statuses.user_id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')->where('users.id', $udUser[0]->id)->get();
        $udAddress = UserAddress::where('user_id', $udUser[0]->id)->get();
        $roles = Role::orderBy('id')->get();


        return view('content.OrderManagement.orderDetails', ['order' => $order, 'product' => $product, 'productImages' => $productImages, "categories" => $categories, 'udUser' => $udUser, 'udStatus' => $udStatus, 'udRole' => $udRole, 'udAddress' => $udAddress, 'roles' => $roles]);
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
        $validate = $request->validate([
            'o_status' => 'required'
        ]);
        if ($validate) {
            $orderUpdate = OrderManagement::where('id', $id)->update([
                'o_status' => $request->o_status
            ]);
            if ($orderUpdate) {
                return back()->with('updateSuccessOrder', "order Updated");
            } else {
                return back()->with('updateErrorOrder', "order Not Updated");
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
        $coupon = OrderManagement::find($id);
        if ($coupon->delete()) {
            return back()->with('successDeleteOrder', 'Order Deleted');
        } else {
            return back()->with('errorDeleteOrder', 'Order Not Deleted');
        }
    }
}
