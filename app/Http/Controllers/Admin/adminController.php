<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Client;
use App\Model\Invoice;
use App\Model\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalProducts = count(Product::all());
        $totalBrands= count(Brand::all());
        $totalCategories = count(Category::all());
        $totalUsers = count(User::all());
        $totalInvoices = count(Invoice::all());
        $totalCustomers = count(Client::all());

        return view('admin.dashboard.index',compact('totalProducts', 'totalBrands', 'totalCategories', 'totalUsers', 'totalInvoices', 'totalCustomers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastWeek()
    {
        $lastWeek = \Carbon\Carbon::today()->subWeek();
        $lastWeek_products = count(Product::where('created_at','>=',$lastWeek)->get());
        $lastWeek_brands = count(Brand::where('created_at','>=',$lastWeek)->get());
        $lastWeek_categories = count(Category::where('created_at','>=',$lastWeek)->get());
        $lastWeek_invoices = count(Invoice::where('created_at','>=',$lastWeek)->get());
        $lastWeek_users = count(User::where('created_at','>=',$lastWeek)->get());
        $lastWeek_customers = count(Client::where('created_at','>=',$lastWeek)->get());

        return view('admin.dashboard.week', compact('lastWeek_products', 'lastWeek_brands', 'lastWeek_categories', 'lastWeek_invoices', 'lastWeek_users', 'lastWeek_customers'));

    }
    public function lastMonth()
    {
        $lastMonth = \Carbon\Carbon::today()->subMonth();
        $lastMonth_products = count(Product::where('created_at','>=',$lastMonth)->get());
        $lastMonth_brands = count(Brand::where('created_at','>=',$lastMonth)->get());
        $lastMonth_categories = count(Category::where('created_at','>=',$lastMonth)->get());
        $lastMonth_invoices = count(Invoice::where('created_at','>=',$lastMonth)->get());
        $lastMonth_users = count(User::where('created_at','>=',$lastMonth)->get());
        $lastMonth_customers = count(Client::where('created_at','>=',$lastMonth)->get());
        return view('admin.dashboard.month', compact('lastMonth_products', 'lastMonth_brands', 'lastMonth_categories', 'lastMonth_invoices', 'lastMonth_users', 'lastMonth_customers'));

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
