<?php

namespace App\Http\Controllers;

use App\Models\OrderManagement;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserStatus;
use Illuminate\Http\Request;

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
        $udUser = User::where('id', $id)->get();
        $udStatus = UserStatus::where('user_id', $id)->get();
        $udRole =  User::join('user_statuses', 'users.id', '=', 'user_statuses.user_id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')->where('users.id', $id)->get();
        $udAddress = UserAddress::where('user_id', $id)->get();
        $roles = Role::orderBy('id')->get();

        $orderData = OrderManagement::where('user_id', $id)->orderBy('id', 'DESC')->paginate(10);

        return response(['udUser' => $udUser, 'udStatus' => $udStatus, 'udRole' => $udRole, 'udAddress' => $udAddress, 'roles' => $roles, 'orderData' => $orderData], 200);
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
