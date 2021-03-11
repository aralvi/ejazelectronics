<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>@yield('title',''){{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/dist/css/custome.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
        @yield('style')
        <script>
            var url = "{{ url('/') }}";
            var token = "{{ csrf_token() }}";
        </script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light grad4" id="grad4">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="mt-1"><a href="{{url('/invoice')}}" class="btn btn-sm btn-dark">Go To Billing</a></li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-img" data-toggle="dropdown" href="#">
                            @if (Auth::user()->avatar != '')
                            <img src="{{asset('uploads/images/user/avatars/'.Auth::user()->avatar)}}" class="avatar-img rounded-circle" alt="..." />
                            @else
                            <img src="{{asset('uploads/images/user/avatars/default.jpg')}}" class="avatar-img rounded-circle" alt="profile" />
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a
                                class="dropdown-item"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"
                            >
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4" id="grad1">
                <!-- Brand Logo -->
                <a href="{{ url('/home') }}" class="brand-link">
                    <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
                    <span class="brand-text font-weight-light">Ijaz Electronics</span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            @if (Auth::user()->avatar != '')
                            <img src="{{asset('uploads/images/user/avatars/'.Auth::user()->avatar)}}" class="img-circle elevation-2" alt="..." style="height: 40px;" />
                            @else
                            <img src="{{asset('uploads/images/user/avatars/default.jpg')}}" class="img-circle elevation-2" alt="profile" />
                            @endif
                        </div>
                        <div class="info">
                            <a href="#" class="d-block text-capitalize name">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                            <li class="nav-item has-treeview @if(request()->is('admin/home'))
                                menu-open
                                @elseif(request()->is('admin/home/last-week'))
                                menu-open
                                @elseif(request()->is('admin/home/last-month'))
                                menu-open
                                @else
                                menu-close
                                @endif
                                ">
                                <a  class="nav-link @if(request()->is('admin/home'))
                                active
                                @elseif(request()->is('admin/home/last-week'))
                                active
                                @elseif(request()->is('admin/home/last-month'))
                                active
                                @else

                                @endif">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Dashboard</p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{url('admin/home')}}" class="nav-link {{request()->is('admin/home') ? 'active' : ''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/home/last-week') }}" class="nav-link {{request()->is('admin/home/last-week') ? 'active' : ''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Weekly Report</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/home/last-month') }}" class="nav-link {{request()->is('admin/home/last-month') ? 'active' : ''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Monthly Report</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{url('admin/categories')}}" class="nav-link {{request()->is('admin/categories') ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{ url('admin/brands') }}" class="nav-link {{request()->is('admin/brands') ? 'active' : ''}}">
                                    <i class="nav-icon fa fa-tag"></i>
                                    <p>Brands</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{ url('admin/products') }}" class="nav-link {{ request()->is('admin/products') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-shopping-bag"></i>
                                    <p>Products</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{ url('admin/invoices') }}" class="nav-link {{ request()->is('admin/invoices') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>Invoices</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{ url('admin/customers') }}" class="nav-link {{ request()->is('admin/customers') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-id-badge"></i>
                                    <p>Customers</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{ url('admin/users') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{ url('admin/profile') }}" class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{ url('admin/change-password') }}" class="nav-link {{ request()->is('admin/password') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <br />
                    <div id="success_errror_any">
                        @if (session('success'))
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success alert-block" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ session('success') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger alert-block" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ session('error') }}</strong>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="container-fluid">
                                <div class="alert alert-danger alert-block" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                @yield('content') @yield('modals')
                            </div>
                        </div>
                        <!-- /.row -->

                        <!-- /.row (main row) -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>This system is developed by  <a href="javascript:void(0)">Oxi-jen</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block"><b>Contact</b> 0304-6118322 / 0332-6991009</div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
        <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <!-- DataTables -->
        <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

        <script>
            $(function () {
                $("#table-search").DataTable({
                    responsive: true,
                    autoWidth: false,
                });
                //Initialize Select2 Elements
                $(".select2").select2();

                //Initialize Select2 Elements
                $(".select2bs4").select2({
                    theme: "bootstrap4",
                });
            });
        </script>
        <script src="{{ asset('admin/dist/js/custome.js') }}"></script>

        @yield('script')
    </body>
</html>
