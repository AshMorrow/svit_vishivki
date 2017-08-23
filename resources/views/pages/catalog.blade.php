@extends('main')
@section('title','Catalog')
@section('content')
    <div class="container catalog_container">
       @include('pages.include._productFilter', ['test' => 'bob'])
        <section id="catalog_container">
            <header class="catalog_filter">
            </header>
            <div class="catalog_products">
                @if($products_data)
                    @foreach($products_data as $product)
                        <div class="catalog_product">
                            <a href="/product/{{$product->url}}">
                                <div class="cp_image">
                                    <img src="/storage/productImages/thumbs/{{$product->id}}/1.jpg"
                                         alt="{{$product->name_ru}}"
                                         onerror="$(this).attr('src','/storage/productImages/thumbs/errors/no-image.jpg')">
                                </div>
                                <div class="cp_price">
                                    <span class="cp_price_new">{{$product->price}} грн</span>
                                </div>
                                <div class="cp_name">{{$product->name_ru}}</div>
                            </a>
                            <button class="cp_addToCart" onclick="Cart.add({{$product->id}},'{{$product->name_ru}}')">
                                Купить
                            </button>
                        </div>
                    @endforeach
                @endif
                <div class="catalog_product"></div>
                <div class="catalog_product"></div>
                <div class="catalog_product"></div>
                <div class="catalog_product"></div>
            </div>
        </section>
    </div>
    <script>
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 500,
                values: [75, 300],
                slide: function (event, ui) {
                    $("#filter_price_value_min").val(ui.values[0]);
                    $("#filter_price_value_max").val(ui.values[1]);
                }
            });
            $("#filter_price_value_min").val($("#slider-range").slider("values", 0));
            $("#filter_price_value_max").val($("#slider-range").slider("values", 1));
        });
    </script>
@endsection