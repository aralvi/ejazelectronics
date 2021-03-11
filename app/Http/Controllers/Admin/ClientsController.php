<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Client;
use App\Model\Invoice;
use App\Model\InvoiceProducts;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Client::all();
        $total = count($customers);
        return view('admin.customers.index', compact('customers', 'total'));
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
            'phone' => 'required|numeric',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'sometimes',
            'role' => 'sometimes',

        ]);
        $customer = new Client();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->city = $request->city;
        $customer->address = $request->address;
        $customer->status = (isset($request->status) ? '1' : '0');
        $customer->role = "1";
        $customer->save();
        return back()->with('success', 'Customer is stored in the database successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Client::findOrFail($id);
        $invoices = Invoice::where('client_id',$customer->id)->get();
        $totalInvoices = count($invoices);
        $total_amount = Invoice::where('client_id',$customer->id)->get()->sum('total_price');
        $net_amount = Invoice::where('client_id',$customer->id)->get()->sum('net_amount');
        return view('admin.customers.customerInfo',compact('customer','invoices','totalInvoices', 'total_amount', 'net_amount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer =  Client::findOrFail($id);
        return view('admin.customers.editCustomer', compact('customer'));
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
            'phone' => 'required|numeric',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'sometimes',
            'role' => 'sometimes',

        ]);
        $customer =  Client::findOrFail($id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->city = $request->city;
        $customer->address = $request->address;
        $customer->status = (isset($request->status) ? '1' : '0');
        $customer->role = "1";
        $customer->save();
        return back()->with('success', 'Customer is updated in the database successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Client::findOrFail($id);
        $customer->delete();
    }
}
