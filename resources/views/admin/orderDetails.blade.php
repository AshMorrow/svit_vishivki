@extends('admin')
@section('title')
    Зказ № {{ $orderData[0]->id }}
@endsection
@section('content')
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Зказ № {{ $orderData[0]->id }}</h3>
        </div>
        <div class="box-body">
            <form id="order-form" method="post" action="">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{ $orderData[0]->id }}">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>
                            <span>Имя: </span>
                        </label>
                        <input class="form-control" value="{{$orderData[0]->name}}" name="name">
                    </div>
                    <div class="form-group">
                        <label>
                            <span>Фамилия: </span>
                        </label>
                        <input class="form-control" value="{{$orderData[0]->last_name}}" name="lastName">
                    </div>
                    <div class="form-group">
                        <label>
                            <span>Email: </span>
                        </label>
                        <input class="form-control" value="{{$orderData[0]->email}}" name="email">
                    </div>
                    <div class="form-group">
                        <label>
                            <span>Телефон:</span>
                        </label>
                        <input type="text" name="phone" id="order_phone" class="form-control"
                               value="{{$orderData[0]->phone}}" name="phone">
                    </div>
                    <div class="form-group">
                        <label>
                            <span>Коментарий: </span>
                        </label>
                        <textarea class="form-control"
                                  name="comment">{{$orderData[0]->comment}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>
                            <span>Способ доставки</span>
                        </label>
                        <select name="delivery_type" class="form-control" id="o_delivery_type"
                                onchange="Order.changeDeliveryType()">
                            <option value="1" {{$orderData[0]->delivery_type == 1? 'selected': ''}}>Самовывоз</option>
                            <option value="2" {{$orderData[0]->delivery_type == 2? 'selected': ''}}>Доставка по Киеву
                            </option>
                            <option value="3" {{$orderData[0]->delivery_type == 3? 'selected': ''}}>Новая почта</option>
                        </select>
                    </div>
                    <div id="o_delivery_address_container" class="form-group"
                         style="{{$orderData[0]->delivery_type != 2? 'display:none': ''}}">
                        <label>
                            <span>Адрес доставки:</span>
                        </label>
                        <input type="text" name="delivery_address" class="form-control" value="{{$orderData[0]->delivery_address}}">
                    </div>
                    <div id="o_new_post_container" style="{{$orderData[0]->delivery_type != 3? 'display:none': ''}}">
                        <div class="form-group">
                            <label>
                                <span>Город:</span>
                            </label>
                            <input type="text" name="n_post_city" id="city_name" class="form-control"
                                   onfocus="(this).select();" value="{{$orderData[0]->n_post_city}}">
                            <div id="city_response" class="response" style="display: none"></div>
                        </div>
                        <div class="form-group">
                            <label>
                                <span>Отделение Новой почты:</span>
                            </label>
                            <select id="n_post_office" name="n_post_office" class="form-control">
                                <option value="{{$orderData[0]->n_post_office}}">{{$orderData[0]->n_post_office}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            <span>Статус заказа:</span>
                        </label>
                        <select class="form-control" name="status">
                            <option value="0" {{$orderData[0]->order_status == 0?  'selected': ''}}>Принят</option>
                            <option value="1" {{$orderData[0]->order_status == 1?  'selected': ''}}>В работе</option>
                            <option value="2" {{$orderData[0]->order_status == 2?  'selected': ''}}>Выполнен</option>
                            <option value="3" {{$orderData[0]->order_status == 3?  'selected': ''}}>Отменен</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <table class="table products-in-order">
                        <tbody>
                        @foreach($orderData as $data)
                            <tr class="order-product"
                                data-id = "{{ $data->product_id }}"
                                data-key = "{{ $data->uniqueKey }}"
                                data-options = "{{ $data->options }}"
                                data-price = "{{ $data->price_per_one }}"
                                data-quantity = "{{ $data->quantity }}"
                            >
                                <td class="img">
                                    <img src="/storage/productImages/thumbs/{{ $data->product_id }}/1.jpg">
                                </td>
                                <td class="product_options">
                                    @php
                                        $name = 'name_'.App::getLocale();
                                        foreach(explode(',',$data->options) as $option_id){
                                            foreach($options as $option){

                                                    if(!in_array($option_id,$option->char_values_id)) continue;
                                                    echo '<div class="option_group"><span>'.$option->$name.'</span>';

                                                foreach($option->char_values_id as $key => $id){
                                                    if($option_id == $id && $option->type != 5){
                                                        echo '<div data-option-type="'.$option->type.'">'.
                                                        $option->char_values[$key].'</div>';
                                                    }elseif (($option_id == $id && $option->type == 5)){
                                                        echo '<div class="product_color"
                                                        style="background-color:'.$option->char_values[$key].'"> </div>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        }
                                    @endphp
                                </td>
                                <td>
                                    <input class="form-control input-mini quantity"
                                           value="{{ $data->quantity }}" onchange="EditOrderForm.recount('{{ $data->uniqueKey }}')">
                                </td>
                                <td>
                                    <span>{{ $data->price_per_one }} грн</span>
                                </td>
                                <td onclick="EditOrderForm.remove('{{ $data->uniqueKey }}')">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="text-left col-md-6">
                    <input id="order-products" type="hidden" name="products" val="">
                    <span id="total-price">{{$orderData[0]->total_price}}</span> грн
                </div>
                <div class="text-right col-md-6">
                    <button class="btn btn-flat btn-success" type="button" onclick="EditOrderForm.send()">Сохранить</button>
                </div>
            </form>
        </div>

    </div>

    <script src="/js/admin/EditOrderForm.js"></script>
    <script src="/js/order.js"></script>
    <script src="/js/maskedinput.min.js"></script>
    <script src="/js/newPost.js"></script>

    <script>
        $(document).ready(function () {
            $('#order_phone').mask("(999) 99-99-999");
            @if($orderData[0]->delivery_type == 3)
            NewPost.getPostOffice('{{$orderData[0]->n_post_city}}', {{$orderData[0]->n_post_office}});
            @endif
            $("#city_name").autocomplete({
                source: function (r, response) {
                    response(NewPost.getCities(r.term))
                },
                select: function (event, ui) {
                    NewPost.getPostOffice(ui.item.value)
                }
            });
        });
    </script>

@endsection