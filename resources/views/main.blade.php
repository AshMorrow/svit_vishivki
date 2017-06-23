<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/mainPage.css">

    <script src="/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.js"></script>
    <script src="/js/cookie.js"></script>
    <script src="/js/cart.js"></script>
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
            <a href="#">
                <i class="glyphicon glyphicon-shopping-cart"></i>
                <span>Корзина</span>
                <span class="badge cart_item_counter">0</span>
            </a>
        </div>
    </nav>
    <div class="m_header_container">
        <div class="m_header_left col-md-3">
            {{--<div class="m_header_phone">(068) 353 15 75</div>--}}
            {{--<div class="m_header_work_howers">c 9<sup>00</sup> до 20<sup>00</sup></div>--}}
        </div>
        <div class="m_header_logo col-md-3">
            <img src="/images/logo.png" alt="head_logo"/>
        </div>
        <div class="m_header_right col-md-3">

        </div>
        <div></div>
    </div>
</header>
<nav id="main_menu" class="nav container">
    <a href="#">Женшинам</a>
    <a href="#">Мужчинам</a>
    <a href="#">Детям</a>
</nav>
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