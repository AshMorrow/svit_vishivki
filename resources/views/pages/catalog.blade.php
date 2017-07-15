@extends('main')
@section('content')
    <div class="container catalog_container">
        <aside id="product_filter">
            <p>
                <label for="amount">Price range:</label>
                <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
            </p>

            <div id="slider-range"></div>
        </aside>
        <section id="catalog_container">
            <header class="catalog_filter">
                    </header>
            <div class="catalog_products">
                <div class="catalog_product">
                    <div class="cp_image">
                        <img src="/storage/productImages/thumbs/1/1.jpg" alt="">
                    </div>
                    <div class="cp_price">
                        <span class="cp_price_new">150 грн</span>
                    </div>
                    <div class="cp_name">Изысканное платье</div>
                    <div class="cp_addToCart">Купить</div>
                </div>
                <!-- -->
                <div class="catalog_product">
                    <div class="cp_image">
                        <img src="/storage/productImages/thumbs/2/2.jpg" alt="">
                    </div>
                    <div class="cp_price">
                        <span class="cp_price_new">250 грн</span>
                    </div>
                    <div class="cp_name">Изысканное платье</div>
                    <div class="cp_addToCart">Купить</div>
                </div>
                <!-- -->
                <div class="catalog_product">
                    <div class="cp_image">
                        <img src="/storage/productImages/thumbs/3/3.jpg" alt="">
                    </div>
                    <div class="cp_price">
                        <span class="cp_price_new">450 грн</span>
                    </div>
                    <div class="cp_name">Изысканное платье</div>
                    <div class="cp_addToCart">Купить</div>
                </div>
                <!-- -->
                <div class="catalog_product">
                    <div class="cp_image">
                        <img src="/storage/productImages/thumbs/3/3.jpg" alt="">
                    </div>
                    <div class="cp_price">
                        <span class="cp_price_new">450 грн</span>
                    </div>
                    <div class="cp_name">Изысканное платье</div>
                    <div class="cp_addToCart">Купить</div>
                </div>
                <div class="catalog_product"></div>
                <div class="catalog_product"></div>
                <div class="catalog_product"></div>
                <div class="catalog_product"></div>
            </div>
        </section>
    </div>
    <script>
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 75, 300 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                }
            });
            $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        } );
    </script>
@endsection