<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Inventory-System | Opps</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}" />

        <!-- Ionicons -->
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}" />

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
        <style>
            h2,
            h3 {
                color: deeppink;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="error-page">
                <h2 class="headline">404</h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle"></i> Oops! Page not found.</h3>

                    <p>We could not find the page you were looking for. Meanwhile, you may <a href="{{url('/')}}">return to main page</a>.</p>
                </div>
            </div>
            <!-- /.content-wrapper -->
        </div>
    </body>
</html>
