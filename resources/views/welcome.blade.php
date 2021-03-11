<!DOCTYPE html>

<html xmlns="" lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{{ config('app.name') }} | Welcome</title>
        <link rel="dns-prefetch" href="//s.w.org" />
        {{--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />  --}}
        <meta name="robots" content="noindex,noarchive" />
        <meta name="referrer" content="strict-origin-when-cross-origin" />
        <meta name="viewport" content="width=device-width" />
    </head>
    <style>
        body{
            background-image: url('{{ asset('login-form/bg-image3.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;

        }
        .title{
            display: flex;
            flex-direction: column;
            align-content: center;
            align-items: center;
        }
        h1{
        font-size: 70px;
        color: deeppink;
        text-shadow: 0px 3px lightpink;
        font-style: italic;
        text-align: center;
        }
        button.login{
            color: white;
            background-color: deeppink !important;
            padding: 10px;
            border-radius: 5px;
            border: none;


        }
        a>:hover,a>button.btn:hover{
            text-decoration: none;
            color: #fff;
            border: 2px solid deeppink;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        }
    </style>
    <body class="text-center">
        <br />
        <br />
        <br />
        <br />
       
        <div class="title">
            <h1 id="title">
                Welcome to <br />
                our shop
            </h1>
            <div class="btn-group">
                <a href="{{ url('admin/login') }}"><button class="login btn btn-lg admin">Login as Owner</button></a>
                <a href="{{ route('login') }}"><button class="login btn btn-lg ml-3 user">Login as Employee</button></a>
            </div>
        </div>
    </body>
</html>
