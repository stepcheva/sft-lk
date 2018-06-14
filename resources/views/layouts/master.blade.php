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
    <script type="text/javascript">
        var _ba = _ba || [];
        _ba.push(["aid", "786c3ca0e45e1b818937890165e6551e"]);
        _ba.push(["host", "dfokeeva.sft.itech-test.ru"]);
        (function () {
            var ba = document.createElement("script");
            ba.type = "text/javascript";
            ba.async = true;
            ba.src = (document.location.protocol == "https:" ? "https://" : "http://") + "bitrix.info/ba.js";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(ba, s);
        })();</script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="cmsmagazine" content="9fd15f69c95385763dcf768ea3b67e22"/>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="SHORTCUT ICON" href="http://dfokeeva.sft.itech-test.ru/lk/favicon.ico" type="image/ico">
    <link href="{{ asset('css/main_lk.css') }}" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
    <script>
        document.createElement('main');
    </script>
    <![endif]-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-71659693-1', 'auto');
        ga('require', 'displayfeatures');
        ga('require', 'linkid', 'linkid.js');
        ga('send', 'pageview');

    </script>

</head>
<body data-page="lk" class="lk">
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaCounter34374340 = new Ya.Metrika({
                    id: 34374340,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true
                });
            } catch (e) {
            }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () {
                n.parentNode.insertBefore(s, n);
            };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/34374340" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->

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

                            @include('layouts.menu', ['user' => $user])

                    </ul>
                </div>
                <div class="mobile-menu-btn js-mobile-btn">
                    <span class="mobile-menu-btn__line"></span>
                </div>

            </div>
        </div>
        <div class="lk-wrapper"> @yield('content') </div>
    </div>
</div>
</body>

<script src="{{ asset('js/libs/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/addons/device.min.js') }}"></script>
<script src="{{ asset('js/addons/modernizr.js') }}"></script>
<script src="{{ asset('js/plugins/fancybox3.3/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('js/plugins/nanoscroller/jquery.nanoscroller.min.js') }}"></script>
<script src="{{ asset('js/plugins/selectize/selectize.min.js') }}"></script>
<script src="{{ asset('js/plugins/swiper4/swiper.min.js') }}"></script>
<script src="{{ asset('js/app_lk-min.js') }}"></script>

@yield('script')

</html>
