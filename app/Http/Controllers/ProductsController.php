<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderManagement;
use App\Models\Products;
use App\Models\ProductsImages;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsData = Category::join('products', 'products.category_id', '=', 'categories.id')->orderBy('products.id', 'DESC')
            // ->get(['products.*', 'categories.c_name', 'categories.id'])
            ->paginate(10);
        return view('content.Inventry.products', ['productsData' => $productsData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('content.Inventry.addProduct', ["categories" => $categories]);
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
            'name' => 'required|unique:products|max:255',
            'description' => 'required',
            'quantity' => 'required',
            'code' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'required',
            'image.*' => 'mimes:jpeg,jpg,png,gif|max:2048'

        ]);
        if ($validate) {
            $createProduct =  new Products();
            $createProduct->name = $request->name;
            $createProduct->description = $request->description;
            $createProduct->price = $request->price;
            $createProduct->code = $request->code;
            $createProduct->quantity = $request->quantity;
            $createProduct->category_id = $request->category_id;
            if ($createProduct->save()) {
                $latestProduct = Products::latest()->first();
                if ($request->hasfile('image')) {
                    $images = $request->file('image');
                    foreach ($images as $i) {
                        $name = rand() . $i->getClientOriginalName();
                        $i->move(public_path('uploads/'), $name);
                        $insertImage =  ProductsImages::insert([
                            'img_path' => $name,
                            'product_id' => $latestProduct->id,
                        ]);
                    }
                    if ($insertImage) {
                        return redirect('product')->with('successProduct', 'User Added');
                    } else {
                        return redirect('product')->with('errorProduct', 'User Not Added');
                    }
                }
            } else {
                return redirect('product')->with('errorProduct', 'User Not Added');
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
        $product = Products::where('products.id', $id)->get();
        // $product = Products::leftJoin('categories', 'products.category_id', '=', 'categories.id')
        //     ->where('products.id', $id)
        //     ->get();
        $productImages = ProductsImages::where('product_id', $id)->get();
        $categories = Category::all();

        $orderData = OrderManagement::where('product_id', $id)->orderBy('id', 'DESC')->paginate(10);
        return view('content.Inventry.productDetails', ['product' => $product, 'productImages' => $productImages, "categories" => $categories, 'orderData' => $orderData]);
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
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'price' => 'required',
        ]);
        if ($validate) {
            $updateProduct =  Products::where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'category_id' => $request->category_id,
            ]);

            if ($updateProduct) {
                // $latestProduct = Products::latest()->first();
                if ($request->hasfile('image')) {
                    $image = ProductsImages::where('product_id', $id)->get();
                    foreach ($image as $i) {
                        unlink("uploads/" . $i->img_path);
                    }
                    ProductsImages::where('product_id', $id)->delete();
                    $images = $request->file('image');
                    foreach ($images as $i) {
                        $name = rand() . $i->getClientOriginalName();
                        $i->move(public_path('uploads/'), $name);
                        $insertImage =  ProductsImages::where('product_id', $id)->insert([
                            'img_path' => $name,
                            'product_id' => $id,
                        ]);
                    }
                    if ($insertImage) {
                        return back()->with('updateSuccessProduct', 'product Updated');
                    } else {
                        return back()->with('updateErrorProduct', 'Product Not Updated');
                    }
                }
                return back()->with('updateSuccessProduct', 'product Updated');
            } else {
                return back()->with('updateErrorProduct', 'product not updated');
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
        $image = ProductsImages::where('product_id', $id)->get();
        foreach ($image as $i) {
            unlink("uploads/" . $i->img_path);
        }
        $deleteProduct = Products::findOrFail($id);
        if ($deleteProduct->delete()) {
            return back()->with('successDeleteProduct', 'product Deleted');
        }
    }
}
