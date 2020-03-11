<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->

    <!--begin::Base Styles -->
    <link rel="stylesheet" type="text/css" href="{{ themes("demo/default/base/style.bundle.css") }}" />
    <!--<link href="./assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" type="text/css" href="{{ themes("vendors/custom/fullcalendar/fullcalendar.bundle.css") }}" />
    <!--<link href="./assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" type="text/css" href="{{ themes("vendors/base/vendors.bundle.css") }}" />
    <!--<link href="./assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" type="text/css" href="{{ themes("demo/default/base/style.bundle.css") }}" />




    <link rel="shortcut icon" href="{{ themes("demo/default/media/img/logo/favicon.ico") }}" />
    <!--end::Base Styles -->

</head>
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" >

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1"  id="m_login" style="background-image: url('{{ themes("/app/media/img/bg/bg-1.jpg") }}');">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container" style="padding: 10px; border: 5px black; border-radius:10%; opacity: 1;">
                <div class="m-login__logo">
                    <a href="#">
                        <img src="{{ themes("/app/media/img/logos/logo-1.png") }}">
                    </a>
                </div>

                <!--begin::SIGN IN-->
                <div class="m-login__signin" >
                    <div class="m-login__head">
                        <h3 class="m-login__title">Se connecter au Back-Office</h3>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->has('email'))
                        <div class="alert alert-danger">
                            {{$errors->first('email')}}
                        </div>
                    @endif
                    @if($errors->has('errorlogin'))
                        <div class="alert alert-danger">
                            {{$errors->first('errorlogin')}}
                        </div>
                    @endif
                    <!--begin::Form-->
                    <form class="m-login__form m-form" action="{{route('admin.login.check')}}" method="POST">
                        @csrf
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="email" placeholder="Email" name="email" autocomplete="off" >
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Mot de passe" name="password">
                            @if($errors->has('password'))
                                <p style="color:red">{{$errors->first('password')}}</p>
                            @endif
                        </div>
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox  m-checkbox--light">
                                    <input type="checkbox" name="remember"> Se souvenir de moi
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary" type="submit" value="login" id="login">Connexion</button>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>
                <!--end::SIGN IN-->
            </div>
        </div>
    </div>
</div>
<!-- end:: Page -->

<!--begin::Base Scripts -->

<script src="{{ themes("/vendors/base/vendors.bundle.js") }}" type="text/javascript"></script>
<script src="{{ themes("/demo/default/base/scripts.bundle.js") }}" type="text/javascript"></script>
<!--end::Base Scripts -->

<!--begin::Page Snippets -->
<script src="{{ themes("/snippets/custom/pages/user/login.js") }}" type="text/javascript"></script>
<!--end::Page Snippets -->


</body>
</html>