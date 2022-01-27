<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannerData = Banner::orderBy('id', 'DESC')->paginate(10);
        return view('content.BannerManagement.banner', ['bannerData' => $bannerData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.BannerManagement.addBanner');
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
            'b_name' => 'required',
            'b_description' => 'required',
            'b_status' => 'required',
        ]);
        if ($validate) {
            $createBanner =  new Banner();
            $createBanner->b_name = $request->b_name;
            $createBanner->b_description = $request->b_description;
            $createBanner->b_status = $request->b_status;
            $image = $request->image[0];
            $name = rand() . $image->getClientOriginalName();
            $image->move(public_path('uploads/'), $name);
            $createBanner->b_img_path = $name;
            if ($createBanner->save()) {
                return redirect('banner')->with('successBanner', 'Banner Added');
            } else {
                return redirect('banner')->with('errorBanner', 'Banner Not Added');
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
        $banner = Banner::where('id', $id)->first();
        return view('content.BannerManagement.editBanner', ['banner' => $banner]);
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
            'b_description' => 'required',
            'b_status' => 'required',
        ]);
        if (!empty($request->image[0])) {
            $d_image = Banner::where('id', $id)->first();
            unlink("uploads/" . $d_image->b_img_path);

            if ($validate) {
                $image = $request->image[0];
                $name = rand() . $image->getClientOriginalName();
                $image->move(public_path('uploads/'), $name);
                $updateBanner =  Banner::where('id', $id)->update([
                    'b_description' => $request->b_description,
                    'b_status' => $request->b_status,
                    'b_img_path' => $name,
                ]);
                if ($updateBanner) {
                    return redirect('banner')->with('successBannerUpdate', 'Banner Updated');
                } else {
                    return redirect('banner')->with('errorBannerUpdate', 'Banner Not Updated');
                }
            }
        } else {
            if ($validate) {
                $updateBanner =  Banner::where('id', $id)->update([
                    'b_description' => $request->b_description,
                    'b_status' => $request->b_status
                ]);
                if ($updateBanner) {
                    return redirect('banner')->with('successBannerUpdate', 'Banner Updated');
                } else {
                    return redirect('banner')->with('errorBannerUpdate', 'Banner Not Updated');
                }
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
        $image = Banner::where('id', $id)->first();

        unlink("uploads/" . $image->b_img_path);


        $deleteBanner = Banner::findOrFail($id);
        if ($deleteBanner->delete()) {
            return back()->with('successDeleteBanner', 'Banner Deleted');
        } else {
            return back()->with('errorDeleteBanner', 'Banner Not Deleted');
        }
    }
}
