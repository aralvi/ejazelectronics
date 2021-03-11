<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        $total = count($brands);
        $categories = Category::all();
        return view('admin/brands/index',compact('brands','total','categories'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',

        ]);

        $brand = new Brand();
        $brand->user_id = Auth::user()->id;
        $brand->category_id = $request->category;
        $brand->name = $request->name;
        $brand->status = (isset($request->status) ? '1' : '0');

        $brand->save();
        return back()->with('success','Brand added successfuly');
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
        $brand = Brand::findOrFail($id);
        $categories = Category::all();
        return view('admin/brands/editBrand',compact('brand','categories'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',

        ]);
        $brand = Brand::findOrFail($id);
        $brand->user_id = Auth::user()->id;
        $brand->name = $request->name;
        $brand->category_id = $request->category;
        $brand->status = (isset($request->status) ? '1' : '0');
        $brand->save();
        return back()->with('success','Brand updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
    }
}
