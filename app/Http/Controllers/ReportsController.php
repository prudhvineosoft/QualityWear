<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_info = DB::table('products')
        //     ->select('category_id as name', DB::raw('sum(quantity) as r'))
        //     ->groupBy('category_id')
        //     ->get();
        $user_info = Category::join('products', 'products.category_id', '=', 'categories.id')->groupBy('categories.c_name')
            ->selectRaw('categories.c_name as name, sum(quantity) as r')
            ->get();
        // return $user_info;
        $dataPoints = [];

        foreach ($user_info as $browser) {

            $dataPoints[] = [
                "name" => $browser->name,
                "y" => floatval($browser->r)
            ];
        }
        //return $dataPoints;
        return view("content.Reports.piechart", [
            "data" => json_encode($dataPoints)
        ]);
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
