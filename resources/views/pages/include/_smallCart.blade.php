@php($product_counter = 0)
<!-- shop cart information container -->
<div id="small_shop_cart" style="display: none">
    <div class="sh_label">Корзина</div>
    <div class="sh_items">

        @if(isset($products) && $products)
            @foreach($products as $id => $product)
                @foreach($product->personalValues as $value)
                    @php($product_counter++)
                    <div class="sh_item cart_item" data-key="{{ $value->uniqueKey }}">
                        <div class="sh_image_container">
                            <img src="/storage/productImages/thumbs/{{ $id }}/1.jpg">
                        </div>
                        <div class="sh_item_information">
                            <div class="item_name">{{ $product->name }}</div>
                            <div class="sh_item_quantity">
                                <input type="text" class="quantity"
                                       value="{{ $value->quantity }}"
                                       onchange="Cart.chQuantity(this,{{ $id }}, '{{ $value->uniqueKey }}')">
                            </div>
                        </div>
                        <div class="sh_remove_item" onclick="Cart.delete({{ $id }}, '{{ $value->uniqueKey }}')">
                            <span class="lnr lnr-trash"></span>
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endif
    </div>
    <div class="sh_open_full_cart">
        <a href="/cart">Оформить заказ</a>
    </div>
</div>

<div onclick="Cart.smallOpenToggle();" class="tc_small_container noselect">
    <i class="lnr lnr-cart"></i>
    <span>Корзина</span>
    <span class="badge cart_item_counter">{{isset($products)? $product_counter: '0'}}</span>
</div>



{!! ob_get_clean() !!}