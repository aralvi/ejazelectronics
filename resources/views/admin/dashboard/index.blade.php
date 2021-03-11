@extends('layouts.admin') @section('title','Home | ') @section('content')

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $totalUsers }}</h3>

                <p class="font-weight-bold">Total Users</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ url('admin/users') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $totalCustomers }}</h3>

                <p class="font-weight-bold">Total Customers</p>
            </div>
            <div class="icon">
                <i class="fa fa-id-badge"></i>
            </div>
            <a href="{{ url('admin/customers') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $totalCategories }}</h3>

                <p class="font-weight-bold">Total Categories</p>
            </div>
            <div class="icon">
                <i class="fa fa-tags"></i>
            </div>
            <a href="{{ url('admin/categories') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $totalBrands }}</h3>

                <p class="font-weight-bold">Total Brands</p>
            </div>
            <div class="icon">
                <i class="fa fa-tag"></i>
            </div>
            <a href="{{ url('admin/brands') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
<div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $totalProducts }}</h3>

                <p class="font-weight-bold">Total Products</p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-bag"></i>
            </div>
            <a href="{{ url('admin/products') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $totalInvoices }}</h3>

                <p class="font-weight-bold">Total Invoices</p>
            </div>
            <div class="icon">
                <i class="fa fa-clipboard"></i>
            </div>
            <a href="{{ url('admin/invoices') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@endsection
