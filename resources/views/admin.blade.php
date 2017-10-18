<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/font_awesome/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/skins/_all-skins.min.css">

    <!-- jQuery 2.2.3 -->
    <script src="/js/jquery.min.js"></script>
    <!-- jquery-ui -->
    <script src="/jquery-ui/jquery-ui.js"></script>
    <link rel="stylesheet" href="/jquery-ui/jquery-ui.css">
    <!-- ckeditor -->
    <script src="/ckeditor/ckeditor.js"></script>
    <!-- My styles -->
    <link rel="stylesheet" href="/css/admin/main.css">
    <link rel="stylesheet" href="/css/admin/order.css">
    <link rel="stylesheet" href="/css/admin/products.css">
</head>
<body class="sidebar-mini skin-black-light  fixed">
<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="/admin" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>V</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Svit</b> Vishivki</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account Menu -->
                <li class="user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="/admin/logout">
                        <span class="">Выйти</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</header>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="active" >
                <a href="/admin/categories"><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Категории</span></a>
            </li>
            <li>
                <a href="/admin/products"><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Товары</span></a>
            </li>
            <li>
                <a href="/admin/orders"><i class="fa fa-shopping-basket" aria-hidden="true"></i> <span>Заказы</span></a>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
<main class="content-wrapper">
    <section class="content">
        @yield('content')
    </section>
</main>
<div id="notifications_holder"></div>
</body>

<script src="/js/admin/main.js"></script>
<script src="/js/admin/ProductsImages.js"></script>
<script src="/js/admin/ProductsForm.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>


</html>