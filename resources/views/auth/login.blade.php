<!DOCTYPE html>
<!--[if IE 8]>
		<html xmlns="http://www.w3.org/1999/xhtml" class="ie8" lang="en-US">
	<![endif]-->
<!--[if !(IE 8)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
    <!--<![endif]-->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{{ config('app.name') }} | Login</title>
        <link rel="dns-prefetch" href="//s.w.org" />
        <link rel='stylesheet' id='dashicons-css' href='{{ asset('login-form/css/dashicons.min.css') }}' media='all' /> <link rel='stylesheet' id='buttons-css' href='{{ asset('login-form/css/buttons.min.css') }}' media='all' /> <link
        rel='stylesheet' id='forms-css' href='{{ asset('login-form/css/forms.min.css') }}' media='all' /> <link rel='stylesheet' id='login-css' href='{{ asset('login-form/css/login.min.css') }}' media='all' />
        <meta name="robots" content="noindex,noarchive" />
        <meta name="referrer" content="strict-origin-when-cross-origin" />
        <meta name="viewport" content="width=device-width" />
    </head>
    <style>
        body{
            background-image: url('{{ asset('login-form/bg-image3.jpg')}}');

            background-repeat: no-repeat;
            background-size: cover;

        }
        label{
            font-weight: 700 !important;
            color: black !important;
        }
        form{
            background-color: #ffffff7d !important;
            border-radius: 32px;
        }
        a{
            color: #444 !important;
            font-weight: 700;
        }
        h1{
            font-weight: 900;
        font-size: 56px;
        color: deeppink;
        text-shadow: 0px 3px lightpink;
        font-style: italic;
        }

        .forget{
            color: black !important;
        }
        #login{
            padding: 0% !important;
        }

        }
    </style>
    <body class="login no-js login-action-login wp-core-ui locale-en-us">
        <script type="text/javascript">
            document.body.className = document.body.className.replace("no-js", "js");
        </script>
        <h1 id="title">
            Welcome to <br />
            Employee Panel
        </h1>
        <div id="login">
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <p>
                    <input type="text" name="role" id="" value="0" style="display: none;" />

                    <label for="user_login">Username or Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror input" size="20" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>

                <div class="user-pass-wrap">
                    <label for="user_pass">Password</label>
                    <div class="wp-pwd">
                        <input id="user_pass" type="password" class="input password-input form-control @error('password') is-invalid @enderror" size="20" name="password" required autocomplete="current-password" />

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror {{-- <input type="password" name="pwd" id="user_pass" class="input password-input" value="" /> --}}
                        <button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="Show password">
                            <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                @if (Route::has('password.request'))
                <a class="btn btn-link forget block" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif

                <p class="submit">
                    <input type="submit" id="wp-submit" class="button button-primary button-large" value="Log In" />
                </p>
            </form>
        </div>
        <script src='{{ asset("login-form/jquery/jquery.js") }}'></script>

        <script src='{{ asset("login-form/js/user-profile.min.js") }}'></script>
        <script>
            /(trident|msie)/i.test(navigator.userAgent) &&
                document.getElementById &&
                window.addEventListener &&
                window.addEventListener(
                    "hashchange",
                    function () {
                        var t,
                            e = location.hash.substring(1);
                        /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus());
                    },
                    !1
                );
        </script>
        
    </body>
</html>
