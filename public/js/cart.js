/**
 * Use for add or remove products to cart/basket
 * @type {{increaseCounter: Cart.increaseCounter, decreaseCounter: Cart.decreaseCounter, addProductToSmallCart: Cart.addProductToSmallCart, add: Cart.add, delete: Cart.delete, chQuantity: Cart.chQuantity, recountTotalPrice: Cart.recountTotalPrice, smallOpenToggle: Cart.smallOpenToggle}}
 */
var Cart = {

    increaseCounter: function () {
        $('#top_cart .cart_item_counter').text(function (index, value) {
            return parseInt(value) + 1;
        })
    },

    decreaseCounter: function () {
        $('#top_cart .cart_item_counter').text(function (index, value) {
            return parseInt(value) - 1;
        })
    },

    /**
     * This function add html element width product.
     * Used in function add.
     * @param productId
     * @param productName
     */
    addProductToSmallCart: function (productId, productName) {
        console.log('product');
        var mainContainer = document.createElement('div');
        mainContainer.className = 'sh_item';
        mainContainer.setAttribute('data-product-id', productId);
        mainContainer.innerHTML = `
            <div class="sh_image_container">
                <img src="/storage/productImages/thumbs/${productId}/1.jpg">
            </div>
            <div class="sh_item_information">
                <div class="item_name">${productName}</div>
                <div class="sh_item_quantity">
                    <input type="text" class="quantity" value="1" data-product-id=${productId} onchange="Cart.chQuantity(this)">
                </div>
            </div>
            <div class="sh_remove_item" onclick="Cart.delete(productId)">
               <span data-icon="f"></span>
            </div>`;

        $('#small_shop_cart .sh_items').append(mainContainer);
    },

    /**
     * Add item to product cart
     * @param productId
     * @param productName
     * @param selectChar
     */
    add: function (productId, productName, selectChar) {
        if (typeof(productId) != 'number') return;
        if (typeof(productName) != 'string' || productName == '') {
            console.log('Enter item name');
            return;
        }

        var isNew = 1;
        var productInCart = Cookie.get('productInCart');
        if (productInCart) {
            productInCart = JSON.parse(productInCart);

            productInCart.items.map(function (product) {
                if (product.id == productId) {
                    product.quantity++;
                    isNew = 0;
                }
            });

            if (isNew) {
                productInCart.items.push({
                    "id": productId,
                    "name": productName,
                    "quantity": 1
                });

                this.addProductToSmallCart(productId, productName);
                console.log('new');
                this.increaseCounter();
            }

        } else {
            productInCart = {
                "items": [{
                    "id": productId,
                    "name": productName,
                    "quantity": 1
                }]

            };
            this.addProductToSmallCart(productId, productName);
            this.increaseCounter();
        }

        Cookie.set('productInCart', JSON.stringify(productInCart), {
            expires: 3600,
            path: '/'
        });

    },

    /**
     * Delete product form cart/basket
     * @param productId
     */
    delete: function (productId) {

        var productInCart = Cookie.get('productInCart');

        if (productInCart) {
            productInCart = JSON.parse(productInCart);
            productInCart.items.map(function (product, i, arr) {
                if (product.id == productId) {
                    arr.splice(i, 1);
                    Cart.recountTotalPrice(0, product.quantity, productId)
                }
            });

            if (productInCart.items.length) {
                Cookie.set('productInCart', JSON.stringify(productInCart), {
                    expires: 36000,
                    path: '/'
                });
            } else {
                Cookie.delete('productInCart');
            }

        }
        this.decreaseCounter();
        $('.cart_item[data-id=' + productId + ']').remove();

    },

    /**
     * Change item quantity in cart/basket
     * @param obj
     * @param productId
     */
    chQuantity: function (obj, productId) {
        var quantity = parseInt($(obj).val());
        if (quantity > 0) {
            var productInCart = Cookie.get('productInCart');
            if (productInCart) {
                productInCart = JSON.parse(productInCart);
                var previousQuantity;
                productInCart.items.map(function (product) {
                    if (product.id == productId) {
                        previousQuantity = product.quantity;
                        product.quantity = quantity;
                    }
                });
                this.recountTotalPrice(previousQuantity, quantity, productId);
                $('.cart_item[data-id=' + productId + ']').find('.quantity').val(quantity);
                Cookie.set('productInCart', JSON.stringify(productInCart), {
                    expires: 3600,
                    path: '/'
                });
            }
        }
    },

    /**
     * Recalculate total price in full cart/basket after delete product or change quantity
     * @param prevQuantity
     * @param quantity
     * @param productId
     */
    recountTotalPrice: function (prevQuantity, quantity, productId) {
        var totalPrice = parseInt($('#total_price').text());
        if (totalPrice) {
            var productPrice = parseInt($('.cart_item[data-id=' + productId + ']').find('.product_price').text());
            if (prevQuantity > 0) {
                totalPrice -= productPrice * prevQuantity;
                totalPrice += productPrice * quantity;
            } else {
                totalPrice -= productPrice * quantity;
            }

            $('#total_price').text(totalPrice);
        }
    },
    /**
     * Select characteristics from product page
     * IMPORTANT:
     *  characteristics container MAST have class "characteristic_group"
     *  and attribute "data-type" with type id
     * Types:
     * --> Size: 4
     * --> Color: 5
     */
    selectCharacteristics: function () {
        var available_characteristics = $('.pd_characteristics .characteristic_group');
        for(var i = 0; i < available_characteristics.length; i++){
            console.log($(available_characteristics[i]).attr('data-type'));
        }

    },
    smallOpenToggle: function () {
        $('#small_shop_cart').fadeToggle();
    },
};