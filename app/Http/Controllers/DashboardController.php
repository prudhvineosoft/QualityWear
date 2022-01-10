<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('user|superadmin|inventory manager|order manager')) {

            return view('userDashboard');
            // https://prudhvineosoft.github.io/covid19/
        } elseif (Auth::user()->hasRole('admin')) {
            return view('dashboard');
        }
    }
}
