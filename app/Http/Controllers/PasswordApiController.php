<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordApiController extends Controller
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
        $details = User::where('email', $id)->get();
        return response(["details" => $details]);
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
        $details = User::where('email', $id)->first();
        $dbpassword = $details->password;
        $oldpassword = $request->oldpassword;
        $newpassword = $request->newpassword;
        $confirmpassword = $request->confirmpassword;
        if ($newpassword == $confirmpassword) {
            if (Hash::check($oldpassword, $dbpassword)) {
                $data = User::where('email', $id)->update([
                    "password" => Hash::make($newpassword)
                ]);
                return response()->json(["message" => "Changed password"]);
            } else {
                return response()->json(["message" => "not updated"]);
            }
        } else {
            return response()->json(["message" => "Mismatched confirm password"]);
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
        //
    }
}
