<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/mainPage.css">
    <link rel="stylesheet" href="/css/order.css">


    <script src="/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.js"></script>
    <script src="/js/cookie.js"></script>
    <script src="/js/cart.js"></script>
    <script src="/js/order.js"></script>
    <script src="/js/maskedinput.min.js"></script>
    <script src="/js/newPost.js"></script>
    <script src="/jquery-ui/jquery-ui.js"></script>

    <!-- favicon star -->
    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- favicon end -->

    <link href="https://file.myfontastic.com/xrtmBtxdTMgFvinym3UKza/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<header class="container">
    <nav class="main_top_nav nav nav-pills nav-justified">
        <div class="language_change">

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