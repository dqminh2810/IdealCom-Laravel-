<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8" />

    <title></title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link rel="stylesheet" type="text/css" href="{{ themes("demo/default/base/style.bundle.css") }}" />
    <!--<link href="./assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" type="text/css" href="{{ themes("vendors/custom/fullcalendar/fullcalendar.bundle.css") }}" />
    <!--<link href="./assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" type="text/css" href="{{ themes("vendors/base/vendors.bundle.css") }}" />
    <!--<link href="./assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" type="text/css" href="{{ themes("demo/default/base/style.bundle.css") }}" />

    <!--<link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />-->
    <link rel="shortcut icon" href="{{ themes("demo/default/media/img/logo/favicon.ico") }}" />
    

	
	@stack('css')
</head>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- BEGIN::Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN::Header -->
        @include('metronic::admin.partials.header')
    <!-- END::Header -->
    <!-- BEGIN::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN::Menu -->
            @include('metronic::admin.partials.menu')
        <!-- END::Menu -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">



            <!-- BEGIN::Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator">@yield('title')</h3>
                        @yield('nav')
                    </div>
                </div>
            </div>
            <!-- END::Subheader -->
            <div class="m-content">
                @if (Session::has('message'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        {{ Session::get('message') }}
                    </div>
                @endif
                    @if (Session::has('alert'))
                        <div class="alert alert-danger">
                            {{ Session::get('alert') }}
                        </div>
                @endif
                <!--Begin::Content-->
                @yield('content')
                <!--End::Content-->
            </div>
        </div>
    </div>
</div>

@include('metronic::admin.partials.footer')
</body>

<!--<script src="./assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>-->
<script src="{{ themes("vendors/base/vendors.bundle.js") }}" type="text/javascript"></script>
<!--<script src="./assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>-->
<script src="{{ themes("demo/default/base/scripts.bundle.js") }}" type="text/javascript"></script>
<!--<script src="./assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>-->
<script src="{{ themes("vendors/custom/fullcalendar/fullcalendar.bundle.js") }}" type="text/javascript"></script>
<!--<script src="./assets/app/js/dashboard.js" type="text/javascript"></script>-->
<script src="{{ themes("app/js/dashboard.js") }}" type="text/javascript"></script>
<script>
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    };
</script>
<script>
    var SessionTimeoutDemo = {
        init: function() {
            $.sessionTimeout({
                title: "Sécurité",
                message: "Votre session va bientôt être fermée.",
                logoutButton: "Se déconnecter",
                keepAliveButton: "Rester connecté",
                redirUrl: "{{ route('admin.logout') }}",
                logoutUrl: "{{ route('admin.logout') }}",
                warnAfter: 900000,
                redirAfter: 960000,
                ignoreUserActivity: false,
                countdownBar: true
            })
        }
    };
    jQuery(document).ready(function() {
        //SessionTimeoutDemo.init()
    });
</script>

@stack('js')
</body>
</html>