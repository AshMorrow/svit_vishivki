@extends('main')
@section('title','Добро пожаловать в магазин')

@section('content')
    <!-- slider begin -->
    <div id="mp_slider" class=" carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            {{--<li data-target="#mp_slider" data-slide-to="0" class="active"></li>--}}
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="/images/slides/slider_1_2.jpg" alt="...">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
        </div>

        <!-- Controls -->
        {{--<a class="left carousel-control" href="#mp_slider" role="button" data-slide="prev">--}}
            {{--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>--}}
            {{--<span class="sr-only">Previous</span>--}}
        {{--</a>--}}
        {{--<a class="right carousel-control" href="#mp_slider" role="button" data-slide="next">--}}
            {{--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>--}}
            {{--<span class="sr-only">Next</span>--}}
        {{--</a>--}}
    </div>
    <!-- end slider -->
    <section class="container">
        <h2 class="text-center">Новинки</h2>

        <div id="carousel_new_products" class="owl-carousel owl-theme">
            <div class="item">
                <div class="photo">
                    <img src="/storage/productImages/thumbs/1/1.jpg" class="img-responsive"
                         alt="a"/>
                </div>
                <div class="info">
                    <div class="price">
                        <h5 class="slide_product_price">$199.99</h5>
                        <h5 class="slide_product_name">Товар 1</h5>
                    </div>
                    <div class="separator clear-left">
                        <button class="btn-add" onclick="Cart.add(1,'Товар 1')">
                            <i class="lnr lnr-cart"></i>
                            <span> Добавить в корзину </span>
                        </button>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="photo">
                    <img src="/storage/productImages/thumbs/2/1.jpg" class="img-responsive"
                         alt="a"/>
                </div>
                <div class="info">
                    <div class="price">
                        <h5 class="slide_product_price">$199.99</h5>
                        <h5 class="slide_product_name">Товар 1</h5>
                    </div>
                    <div class="separator clear-left">
                        <button class="btn-add" onclick="Cart.add(1,'Товар 1')">
                            <i class="lnr lnr-cart"></i>
                            <span> Добавить в корзину </span>
                        </button>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="photo">
                    <img src="/storage/productImages/thumbs/3/1.jpg" class="img-responsive"
                         alt="a"/>
                </div>
                <div class="info">
                    <div class="price">
                        <h5 class="slide_product_price">$199.99</h5>
                        <h5 class="slide_product_name">Товар 1</h5>
                    </div>
                    <div class="separator clear-left">
                        <button class="btn-add" onclick="Cart.add(1,'Товар 1')">
                            <i class="lnr lnr-cart"></i>
                            <span> Добавить в корзину </span>
                        </button>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center">Популярные</h2>

        <div id="carousel_new_products" class="owl-carousel owl-theme">
            <div class="item">
                <div class="photo">
                    <img src="/storage/productImages/thumbs/1/1.jpg" class="img-responsive"
                         alt="a"/>
                </div>
                <div class="info">
                    <div class="price">
                        <h5 class="slide_product_price">$199.99</h5>
                        <h5 class="slide_product_name">Товар 1</h5>
                    </div>
                    <div class="separator clear-left">
                        <button class="btn-add" onclick="Cart.add(1,'Товар 1')">
                            <i class="lnr lnr-cart"></i>
                            <span> Добавить в корзину </span>
                        </button>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="photo">
                    <img src="/storage/productImages/thumbs/2/1.jpg" class="img-responsive"
                         alt="a"/>
                </div>
                <div class="info">
                    <div class="price">
                        <h5 class="slide_product_price">$199.99</h5>
                        <h5 class="slide_product_name">Товар 1</h5>
                    </div>
                    <div class="separator clear-left">
                        <button class="btn-add" onclick="Cart.add(1,'Товар 1')">
                            <i class="lnr lnr-cart"></i>
                            <span> Добавить в корзину </span>
                        </button>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="photo">
                    <img src="/storage/productImages/thumbs/3/1.jpg" class="img-responsive"
                         alt="a"/>
                </div>
                <div class="info">
                    <div class="price">
                        <h5 class="slide_product_price">$199.99</h5>
                        <h5 class="slide_product_name">Товар 1</h5>
                    </div>
                    <div class="separator clear-left">
                        <button class="btn-add" onclick="Cart.add(1,'Товар 1')">
                            <i class="lnr lnr-cart"></i>
                            <span> Добавить в корзину </span>
                        </button>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>
        $('.carousel').carousel();
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
@endsection