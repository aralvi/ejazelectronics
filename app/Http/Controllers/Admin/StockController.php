<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
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
            'new_stock' => 'required|string|max:255',

        ]);
        $stock = new Stock();
        $stock->product_id = $request->product_id;
        $stock->new_stock = $request->new_stock;
        $stock->date = $request->date;
        $stock->save();
        $product = Product::findOrFail($request->product_id);
        $product->stock = $product->stock + $request->new_stock;
        $product->save();
        return back()->with('success', 'Stock added successfuly');
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
        $stock = Stock::findOrFail($id);
        return view('admin.stocks.editStock',compact('stock'));
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
            'new_stock' => 'required|string|max:255',

        ]);
        $product = Product::findOrFail($request->product_id);
        $stock = Stock::findOrFail($id);
        $product->stock = $product->stock - $stock->new_stock;
        $product->user_id = Auth::user()->id;
        $product->save();
        $stock->user_id = Auth::user()->id;
        $stock->product_id = $request->product_id;
        $stock->new_stock = $request->new_stock;
        $stock->date = $request->date;
        $product->stock = $product->stock + $request->new_stock;
        $product->save();
        $stock->save();
        return back()->with('success', 'Stock updated successfuly');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $product = Product::findOrFail($stock->product_id);
        $product->stock = $product->stock - $stock->new_stock;
        $product->save();
        $stock->delete()->with('success', 'Stock deleted successfuly');


    }
}
