<?php

namespace App\Http\Controllers;

use App\Http\Resources\json;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class apiContactController extends Controller
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|digits:10',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'validation error']);
        } else {
            $newContact = new Contacts();
            $newContact->name = $request->name;
            $newContact->phone = $request->phone;
            $newContact->message = $request->message;
            $newContact->user_id = $request->user_id;
            if ($newContact->save()) {
                return response(['newContact' => new json($newContact), 'message' => 'create successfully', 'err' => 0], 200);
            } else {
                return response(['msg' => 'Contact not added', 'err' => 1], 200);
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
