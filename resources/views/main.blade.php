<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/mainPage.css">
    <link rel="stylesheet" href="/css/order.css">
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/catalog.css">
    <link rel="stylesheet" href="/css/product.css">


    <script src="/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.js"></script>
    <script src="/js/cookie.js"></script>
    <script src="/js/cart.js"></script>
    <script src="/js/order.js"></script>
    <script src="/js/functions.js"></script>
    <script src="/js/maskedinput.min.js"></script>
    <script src="/js/newPost.js"></script>
    <script src="/jquery-ui/jquery-ui.js"></script>

    <!-- product gallery -->
    <link rel="stylesheet" href="/gallery/css/gallery.css">
    <script src="/gallery/js/gallery.js"></script>

    <!-- bx_slider -->
    <link rel="stylesheet" href="/bxslider/jquery.bxslider.min.css">
    <script src="/bxslider/jquery.bxslider.min.js"></script>

    <!-- favicon star -->
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/manifest.json">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <!-- favicon end -->

    {{--<link href="https://file.myfontastic.com/xrtmBtxdTMgFvinym3UKza/icons.css" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Ubuntu:300,400,500,700"
          rel="stylesheet">
</head>
<body>
<header class="container">
    <nav class="main_top_nav nav nav-pills nav-justified">
        <div class="language_change">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                <div {!! App::getLocale() == $properties['lan'] ? "class='active'": ''!!}>
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['lan'] }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="info_nav">
            <a href="#">Доставка и оплата</a>
            <a href="#">Про нас</a>
            <a href="#">Возврат</a>
        </div>
        <div class="cart" id="top_cart">
            @include('pages.include._smallCart')
        </div>
    </nav>
    <div class="m_header_container">
        <div class="m_header_left col-md-3">
            {{--<div class="m_header_phone">(068) 353 15 75</div>--}}
            {{--<div class="m_header_work_howers">c 9<sup>00</sup> до 20<sup>00</sup></div>--}}
        </div>
        <div class="m_header_logo col-md-3">
            <a href="/"><img src="/images/logo.png" alt="head_logo"/></a>
        </div>
        <div class="m_header_right col-md-3">

        </div>
        <div></div>
    </div>
</header>
@include('pages.include._mainNav')
<div class="clearfix"></div>
<main>
    @yield('content')
</main>
<footer>
    <div class="container corporate_info">
        © {{ date('Y') }}
    </div>

</footer>
</body>
</html>