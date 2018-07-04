<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="robots" content="index, follow"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="SHORTCUT ICON" href="http://dfokeeva.sft.itech-test.ru/lk/favicon.ico" type="image/ico">
    <link href="{{ asset('css/main_lk.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/plugins/fancybox3.3/jquery.fancybox.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/plugins/swiper4/swiper.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/plugins/nanoscroller.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/plugins/selectize.css') }}" rel="stylesheet" type="text/css">

    @stack("head")

    <!--[if lt IE 9]>
    <script>
        document.createElement('main');
    </script>
    <![endif]-->

</head>
<body data-page="lk" class="lk">

<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div id="root-wrapper">
    <div id="site-wrapper">
        <div class="b-site_header">
            <div class="content-wrapper-header">
                <div class="logo"><a href="http://sftgroup.ru/" class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="logo"></a>
                </div>
                <div class="b-topnav js-mobile-menu">
                    <ul class="b-topnav__list">

                        @if(isset($user) || isset($applicator))
                            @include('layouts.menu', ['user' => $user])
                        @endif

                    </ul>
                </div>
                <div class="mobile-menu-btn js-mobile-btn">
                    <span class="mobile-menu-btn__line"></span>
                </div>

            </div>
        </div>
        <div class="lk-wrapper"> @yield('content') </div>
        <div> @stack('hidden') </div>
    </div>
</div>

</body>
@stack("script")
<script src="{{ asset('js/libs/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/addons/device.min.js') }}"></script>
<script src="{{ asset('js/addons/modernizr.js') }}"></script>
<script src="{{ asset('js/plugins/fancybox3.3/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('js/plugins/nanoscroller/jquery.nanoscroller.min.js') }}"></script>
<script src="{{ asset('js/plugins/selectize/selectize.min.js') }}"></script>
<script src="{{ asset('js/plugins/swiper4/swiper.min.js') }}"></script>
<script src="{{ asset('js/app_lk-min.js') }}"></script>

</html>
