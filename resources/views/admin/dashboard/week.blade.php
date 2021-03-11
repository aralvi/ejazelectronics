@extends('layouts.admin') @section('title','Weekly Repo | ') @section('content')

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $lastWeek_users }}</h3>

                <p class="font-weight-bold">Total Users</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $lastWeek_customers }}</h3>

                <p class="font-weight-bold">Total Cstomersu</p>
            </div>
            <div class="icon">
                <i class="fa fa-id-badge"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $lastWeek_categories }}</h3>

                <p class="font-weight-bold">Total Categories</p>
            </div>
            <div class="icon">
                <i class="fa fa-tags"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $lastWeek_brands }}</h3>

                <p class="font-weight-bold">Total Brands</p>
            </div>
            <div class="icon">
                <i class="fa fa-tag"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $lastWeek_products }}</h3>

                <p class="font-weight-bold">Total Products</p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-bag"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box">
            <div class="inner">
                <h3>{{ $lastWeek_invoices }}</h3>

                <p class="font-weight-bold">Total Invoices</p>
            </div>
            <div class="icon">
                <i class="fa fa-clipboard"></i>
            </div>
        </div>
    </div>
</div>
@endsection
