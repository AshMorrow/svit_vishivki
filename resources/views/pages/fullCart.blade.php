    @extends('main')
@section('content')
    <div class="wrapper container">
        <aside class="col-md-4">
            <form id="order_form" method="post">
                {{csrf_field()}}
                <label>
                    <div>Имя:</div>
                    <input type="text" name="first_name" required>
                </label>
                <label>
                    <div>Фамилия:</div>
                    <input type="text" name="last_name" >
                </label>
                <label>
                    <div>Email:</div>
                    <input type="email" required name="email">
                </label>
                <label>
                    <div>Телефон:</div>
                    <input type="text" name="phone" id="order_phone" required>
                </label>
                <label>
                    <div>Коментарий:</div>
                    <textarea name="comment"></textarea>
                </label>
                <label>
                    <div>Способ доставки</div>
                    <select name="delivery_type" id="o_delivery_type" onchange="Order.changeDeliveryType()">
                        <option value="1">Самовывоз</option>
                        <option value="2">Доставка по Киеву</option>
                        <option value="3">Новая почта</option>
                    </select>
                </label>
                <label id="o_delivery_address_container" style="display: none">
                    <div>Адрес доставки:</div>
                    <input type="text" name="delivery_address">
                </label>
                <div id="o_new_post_container" style="display: none">
                    <label>
                        <div>Город:</div>
                        <input type="text" name="n_post_city" id="city_name"
                               {{--onkeyup="NewPost.callCities()"--}}
                               onfocus="(this).select();">
                        <div id="city_response" class="response" style="display: none"></div>
                    </label>
                    <label>
                        <div>Отделение<br> Новой почты:</div>
                        <select id="n_post_office" name="n_post_office"></select>
                    </label>
                </div>
                <button type="submit">Оформить зказ</button>
            </form>
        </aside>
        <section id="order_products_list">
            @if($products_for_order)
                {{--{{dd($products_for_order)}}--}}
                @foreach($products_for_order as $product)
                    <div class="o_product cart_item" data-id="{{$product->id}}">
                        <div class="o_product_img_container">
                            <img src="\storage\productImages\thumbs\{!! $product->id !!}\{!! $product->main_image !!}.jpg"
                                 alt="{!! $product->name_ru !!}_thumb">
                        </div>
                        <div class="o_product_details">
                            <div class="o_product_name">
                                <span>{!! $product->name_ru !!}</span>
                            </div>
                            <div class="o_product_characteristics">
                                <div class="o_char_group">
                                    <div>
                                        Цвет: Красный
                                    </div>
                                    <div>
                                        Размер: М
                                    </div>
                                </div>
                                <div class="o_quantity">
                                    <input type="text" class="quantity" value="{!! $product->quantity !!}"
                                           onchange="Cart.chQuantity(this,{{$product->id}})">
                                </div>
                                <div class="o_product_price">
                                    <span class="product_price">{{$product->price}}</span>
                                    <span> грн.</span>
                                </div>
                                <div class="o_product_remove" onclick="Cart.delete({{$product->id}})">
                                    <span class="lnr lnr-trash"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="o_price_total">
                    <span>Итого</span>
                    <span id="total_price">{!! $total_price !!}</span>
                    <span>грн.</span>
                </div>
            @else
                Корзина пуста
            @endif
        </section>
    </div>
    <script>
        $('#order_phone').mask('(999) 999-9999');
        $("#city_name").autocomplete({
            source: function (r, response) {
                response(NewPost.getCities(r.term))
            },
            select: function (event, ui) {
                console.log(ui);
                NewPost.getPostOffice(ui.item.value)
            }
        });
    </script>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection