<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\Customer;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->status == 'Active'){

            if(Auth::user()->role == 'Admin'){
                return redirect('admin/home');
            }else{
                $products = Product::all();
                return view('home', compact('products'));
            }
        }else{
            return view('404');
        }
    }
    public function generate()
    {
        if(Auth::user()->status == 'Active'){

                $products = Product::all();
                $clients = Client::all();
                return view('home', compact('products','clients'));
        }else{
            return redirect('404');
        }
    }
}
