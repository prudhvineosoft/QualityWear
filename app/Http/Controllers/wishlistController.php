<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class wishlistController extends Controller
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
        // return response($request);
        $check = Wishlist::where('user_email', $request->user_email)->get();
        $flag = 0;
        foreach ($check as $i) {
            if ($i->product_id == $request->product_id) {
                $flag = 1;
                break;
            }
        }
        if ($flag != 0) {
            return response()->json(['err' => 1, "message" => "already added"]);
        } else {
            $data = Wishlist::insert([
                "user_email" => $request->user_email,
                "pro_id" => $request->pro_id,
                "product_id" => $request->product_id,
                "product_name" => $request->product_name,
                "product_price" => $request->product_price,
                "image_path" => $request->image_path,

            ]);
            return response()->json(['err' => 0, "data" => $data, "message" => "added"]);
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
        $data = Wishlist::where('user_email', $id)->get();
        return response()->json(["items" => $data]);
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
        $data = Wishlist::find($id);
        if ($data->delete()) {
            return response(["message" => "deleted successfully", 'err' => 0]);
        }
    }
}
