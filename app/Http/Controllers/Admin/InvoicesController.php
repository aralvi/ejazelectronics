<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Client;
use App\Model\Invoice;
use App\Model\InvoiceProducts;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        $total = count($invoices);
        return view('admin.invoices.index',compact('invoices','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.invoices.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->customer){
            $invoice = new Invoice();
            $invoice->user_id = Auth::user()->id;
            $invoice->client_id = $request->customer;
            $invoice->total_products = count($request->products);
            $invoice->total_price = $request->grandTotal;
            $invoice->total_discount = $request->total_discount;
            $invoice->net_amount = $request->netAmount;
            $invoice->return_amount = $request->returnAmount;
            $invoice->save();
            // if ($request->has('products')) {
            //     $invoice->Products()->attach($request->products,['price'=> 100, 'quantity' => 1]);
            // }

            foreach ($request->products as $key => $product) {
                $invoiceProduct = new InvoiceProducts();
                $invoiceProduct->invoice_id = $invoice->id;
                $invoiceProduct->product_id = $product;
                $invoiceProduct->price = $request->price[$key];
                $invoiceProduct->discount = $request->proDiscount[$key];
                $invoiceProduct->quantity = $request->quantity[$key];
                $invoiceProduct->save();
            }
            foreach ($request->products as $key => $product) {
                $sale = Product::findOrFail($product);
                $sale->stock = $sale->stock - $request->quantity[$key];
                $sale->sold = $sale->sold + $request->quantity[$key];
                $sale->save();
            }
        }else{
            $client = new Client();
            if ($request->client_name != '') {

                $client->name = $request->client_name;
            } else {
                $client->name = 'Walking Customer';
            }
            if ($request->phone != '') {

                $client->phone = $request->phone;
            } else {
                $client->phone = 'xxxx xxxxxxx  ';
            }

            $client->save();
            $invoice = new Invoice();
            $invoice->user_id = Auth::user()->id;
            $invoice->client_id = $client->id;
            $invoice->total_products = count($request->products);
            $invoice->total_price = $request->grandTotal;
            $invoice->total_discount = $request->total_discount;
            $invoice->net_amount = $request->netAmount;
            $invoice->return_amount = $request->returnAmount;
            $invoice->save();
            // if ($request->has('products')) {
            //     $invoice->Products()->attach($request->products,['price'=> 100, 'quantity' => 1]);
            // }

            foreach ($request->products as $key => $product) {
                $invoiceProduct = new InvoiceProducts();
                $invoiceProduct->invoice_id = $invoice->id;
                $invoiceProduct->product_id = $product;
                $invoiceProduct->price = $request->price[$key];
                $invoiceProduct->discount = $request->proDiscount[$key];
                $invoiceProduct->quantity = $request->quantity[$key];
                $invoiceProduct->save();
            }
            foreach ($request->products as $key => $product) {
                $sale = Product::findOrFail($product);
                $sale->stock = $sale->stock - $request->quantity[$key];
                $sale->sold = $sale->sold + $request->quantity[$key];
                $sale->save();
            }

        }

        return redirect('print-invoice/'.$invoice->id);
        // return back()->with('success', 'Invoice generated successfuly');


    }
    function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('clients')
                ->where('name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
       <li><a href="#">' . $row->name . '</a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
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
        $invoice = Invoice::findOrFail($id);
        $invoiceProducts = InvoiceProducts::where('invoice_id',$id)->get();
        return view('admin/invoices/viewInvoice',compact('invoice','invoiceProducts'));
    }
    public function print($id)
    {
         $invoice = Invoice::findOrFail($id);
        $invoiceProducts = InvoiceProducts::where('invoice_id',$id)->get();
        return view('printInvoice',compact('invoice','invoiceProducts'));
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
        $invoice = Invoice::findOrFail($id)->delete();
        return 'Invoice deleted successfuly';
    }
}
