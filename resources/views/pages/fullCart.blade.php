@extends('main')
@section('content')
    <div class="wrapper container">
        @if($products_for_order)
            @php
                $name = 'name_'. $lan;
            @endphp
            <aside class="col-md-4">
                <form id="order_form" method="post">
                    {{csrf_field()}}
                    <label>
                        <div>Имя:</div>
                        <input type="text" name="first_name" required>
                    </label>
                    <label>
                        <div>Фамилия:</div>
                        <input type="text" name="last_name">
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
                @foreach($products_for_order as $product)
                    @foreach($product->personalValues as $value)
                        <div class="o_product cart_item" data-key="{{ $value->uniqueKey }}">
                            <div class="o_product_img_container">
                                <img src="\storage\productImages\thumbs\{!! $product->id !!}\{!! $product->main_image !!}.jpg"
                                     alt="{{ $product->$name }}_thumb">
                            </div>
                            <div class="o_product_details">
                                <div class="o_product_name">
                                    <span>{{ $product->$name }}</span>
                                </div>
                                <div class="o_product_information">
                                    <div class="o_product_options">
                                        @foreach($options as $option)
                                            @php
                                                $option_ids = explode(',', $option->char_values_id);
                                                $option_values = explode(',', $option->char_values);
                                            @endphp
                                            @foreach($option_ids as $key => $id)
                                                @if(in_array($id, $value->characteristics))
                                                    <div class="o_char_group">
                                                        <span>{{ $option->$name }}</span>
                                                        @if($option->type != 5 )
                                                            <div data-type="{{ $option->type }}">
                                                                {{$option_values[$key]}}
                                                            </div>
                                                        @else
                                                            <div data-type="{{ $option->type }}">
                                                                <div style="background-color: {{$option_values[$key]}}"></div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <div class="o_quantity">
                                        <input data-uniqueKey="{{ $value->uniqueKey }})" type="text"
                                               class="quantity" value="{!! $value->quantity !!}"
                                               onchange="Cart.chQuantity(this, {{ $product->id }}, '{{ $value->uniqueKey }}')">
                                    </div>
                                    <div class="o_product_price">
                                        <span class="product_price">{{ number_format($product->price,2)}}</span>
                                        <span> грн.</span>
                                    </div>
                                    <div class="o_product_remove"
                                         onclick="Cart.delete({{$product->id}}, '{{ $value->uniqueKey }}')">
                                        <span class="lnr lnr-trash"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
                <div class="o_price_total">
                    <span>Итого</span>
                    <span id="total_price">{!! $total_price !!}</span>
                    <span>грн.</span>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </section>
        @else
            <div class="no_products_in_cart">

                <span class="icon"></span>
                <span> @lang('cart.no_products_in_cart') :( </span>

            </div>
        @endif
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

@endsection