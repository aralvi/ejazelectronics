<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Product;
use App\Model\Stock;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $total = count($products);
        $brands = Brand::all();
        $stocks = Stock::all();
        return view('admin/products/index',compact('products','total','brands','stocks'));

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
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $product = new Product();
        if ($proImage = $request->file('image')) {
            $proImage_original_name = $proImage->getClientOriginalName();
            $image_changed_name = time() . '_' . str_replace('', '-', $proImage_original_name);
            $destinationPath = 'public/uploads/images/products/'; // upload path
            $proImage->move($destinationPath, $image_changed_name);
            $product->image = $image_changed_name;
        }

        $product->name = $request->name;
        $product->brand_id = $request->brand;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->retail = $request->retail;
        $product->status = (isset($request->status) ? '1':'0');
        $product->save();
        $stock = new Stock();
        $stock->product_id = $product->id;
        $stock->new_stock = $product->stock;
        $stock->date = $product->created_at;
        $stock->save();
        return back()->with('success', 'Product added successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $stocks = Stock::orderBy('date','desc')->get();

        return view('admin.products.productInfo',compact('product','stocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        return view('admin/products/editProduct', compact('product', 'brands'));
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
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'sometimes',
        ]);
        $product =  Product::findOrFail($id);
        if ($proImage = $request->file('image')) {
            $proImage_original_name = $proImage->getClientOriginalName();
            $image_changed_name = time() . '_' . str_replace('', '-', $proImage_original_name);
            $destinationPath = 'public/uploads/images/products/'; // upload path
            $proImage->move($destinationPath, $image_changed_name);
            $product->image = $image_changed_name;
        }

        $product->name = $request->name;
        $product->brand_id = $request->brand;
        $product->price = $request->price;
        $product->retail = $request->retail;
        $product->status = (isset($request->status) ? '1':'0');
        $product->save();


        return back()->with('success', 'Product updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return 'Product deleted successfuly';
    }
}
