<?php

namespace App\Http\Controllers;

use App\Models\OrderManagement;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserStatus;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function showUsers()
    {
        $users = User::join('user_statuses', 'users.id', '=', 'user_statuses.user_id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->orderBy('users.id', 'DESC')
            ->paginate(10);
        return view('content/userManagement/userCrud', ["usersData" => $users]);
    }
    public function addUserPage()
    {
        $roles = Role::orderBy('id')->get();
        return view('auth.register', ['roles' => $roles]);
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->attachRole($request->role_id);
        if ($user) {
            $newuser = User::latest()->first();
            $status = UserStatus::insert([
                'user_id' => $newuser->id,
                'status' => $request->status
            ]);
            if ($status) {
                return redirect('users')->with('successUser', 'User Added');
            } else {
                return redirect('users')->with('errorUser', 'User Not Added');
            }
        }
    }
    public function deleteUser($id)
    {
        if (User::where('id', $id)->delete()) {
            DB::delete('DELETE FROM role_user WHERE user_id = ?', [$id]);
            echo ("User Record deleted successfully.");
            return back()->with('successDelete', 'User deleted');
        } else {
            return back()->with('errorDelete', 'User Not deleted');
        }
    }
    public function userDetails($id)
    {
        $udUser = User::where('id', $id)->get();
        $udStatus = UserStatus::where('user_id', $id)->get();
        $udRole =  User::join('user_statuses', 'users.id', '=', 'user_statuses.user_id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')->where('users.id', $id)->get();
        $udAddress = UserAddress::where('user_id', $id)->get();
        $roles = Role::orderBy('id')->get();

        $orderData = OrderManagement::where('user_id', $id)->orderBy('id', 'DESC')->paginate(10);

        return view('content.UserManagement.userDetails', ['udUser' => $udUser, 'udStatus' => $udStatus, 'udRole' => $udRole, 'udAddress' => $udAddress, 'roles' => $roles, 'orderData' => $orderData]);
    }
    public function editUser(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required',
        ]);
        if ($validate) {
            $updateUser = User::where('id', $req->id)->update([
                'name' => $req->name,
            ]);
            if ($updateUser) {
                return back()->with('updateSuccess', 'Updated Successfully');
            }
        }
    }
}
