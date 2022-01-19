<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\configuration;

class configurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = configuration::all();
        return view("content.Configuration.configuration", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.Configuration.addConfiguration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = configuration::insert([
            "phone_no" => $request->phone,
            "admin_email" => $request->adminEmail,
            "notification_email" => $request->notificationEmail
        ]);
        return redirect("dashboard/configuration");
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
        $data = configuration::find($id);
        return view("content.Configuration.editconfiguration", compact("data"));
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
        configuration::where('id', $id)->update([
            "phone_no" => $request->phone,
            "admin_email" => $request->adminEmail,
            "notification_email" => $request->notificationEmail,
        ]);
        return redirect("dashboard/configuration");
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
