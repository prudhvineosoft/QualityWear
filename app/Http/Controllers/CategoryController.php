<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryData = Category::orderBy('id', 'DESC')->paginate(10);
        return view('content.Inventry.catagory', ['categoryData' => $categoryData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.Inventry.addCategory');
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
            'c_name' => 'required|unique:categories|max:255',
            'description' => 'required',
        ]);
        if ($validate) {
            $createCategory =  new Category();
            $createCategory->c_name = $request->c_name;
            $createCategory->description = $request->description;
            if ($createCategory->save()) {
                return redirect('dashboard/category')->with('successCategory', 'User Added');
            } else {
                return redirect('dashboard/category')->with('errorCategory', 'User Not Added');
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
        $category = Category::where('id', $id)->get();

        $productsData = Category::join('products', 'products.category_id', '=', 'categories.id')->where('products.category_id', $id)->orderBy('products.id', 'DESC')
            // ->get(['products.*', 'categories.c_name', 'categories.id'])
            ->paginate(10);
        return view('content.Inventry.categoryDetails', ['category' => $category, 'productsData' => $productsData],);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
            'c_name' => 'required',
            'description' => 'required'
        ]);
        if ($validate) {
            $updateCategory = Category::where('id', $id)->update([
                'c_name' => $request->c_name,
                'description' => $request->description
            ]);
            if ($updateCategory) {
                return back()->with('updateSuccessCategory', 'Updated Successfully');
            } else {
                return back()->with('updateErrorCategory', 'Category Already Inserted');
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
        $catDelete = Category::findOrFail($id);

        if ($catDelete->delete()) {
            return back()->with('successDelete', 'Category Deleted');
        }
    }
}
