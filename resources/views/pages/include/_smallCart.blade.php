<div  onclick="Cart.smallOpenToggle();" class="tc_small_container noselect">
    <i class="lnr lnr-cart"></i>
    <span>Корзина</span>
    <span class="badge cart_item_counter">{{isset($products)? count($products): '0'}}</span>
</div>

<!-- shop cart information container -->
<div id="small_shop_cart" style="display: none">
    <div class="sh_label">Корзина</div>
    <div class="sh_items">
        @if(isset($products))
            @foreach($products as $product)
                <div class="sh_item cart_item" data-id="{{$product->id}}">
                    <div class="sh_image_container">
                        <img src="/storage/productImages/thumbs/{{$product->id}}/1.jpg">
                    </div>
                    <div class="sh_item_information">
                        <div class="item_name">{{$product->name}}</div>
                        <div class="sh_item_quantity">
                            <input type="text" class="quantity"
                                   value="{{$product->quantity}}"
                                   onchange="Cart.chQuantity(this,{{$product->id}})">
                        </div>
                    </div>
                    <div class="sh_remove_item" onclick="Cart.delete({{$product->id}})">
                        <span data-icon="f"></span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="sh_open_full_cart">
        <a href="/cart">Оформить заказ</a>
    </div>
</div>