/**
 * Use for add or remove products to cart/basket
 * @type {{increaseCounter: Cart.increaseCounter, decreaseCounter: Cart.decreaseCounter, addProductToSmallCart: Cart.addProductToSmallCart, add: Cart.add, delete: Cart.delete, chQuantity: Cart.chQuantity, recountTotalPrice: Cart.recountTotalPrice, smallOpenToggle: Cart.smallOpenToggle}}
 */
var Cart = {

    cookieExpiresTime: 31536000,

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
     * @param uniqueKey
     */
    addProductToSmallCart: function (productId, productName, uniqueKey) {
        Cart.productId = productId;
        var mainContainer = document.createElement('div');
        mainContainer.className = 'sh_item';
        mainContainer.setAttribute('data-product-id', productId);
        mainContainer.setAttribute('data-key', uniqueKey);
        mainContainer.innerHTML = `
            <div class="sh_image_container">
                <img src="/storage/productImages/thumbs/${productId}/1.jpg">
            </div>
            <div class="sh_item_information">
                <div class="item_name">${productName}</div>
                <div class="sh_item_quantity">
                    <input type="text" class="quantity" value="1" data-product-id=${productId} onchange="Cart.chQuantity(this, productId, '${uniqueKey}')">
                </div>
            </div>
            <div class="sh_remove_item" onclick="Cart.delete(${productId}, ${uniqueKey})">
               <span class="lnr lnr-trash"></span>
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

        var isNew = true,
            addNewCharacteristics = true,
            productInCart = Cookie.get('productInCart'),
            selectedCharacteristics = [{}],
            uniqueKey = Math.random().toString(36);
        // If some pro
        if (productInCart) {
            productInCart = JSON.parse(productInCart);

            if (selectChar) {
                selectedCharacteristics = Cart.selectCharacteristics();
            }

            // Try figure ned add product with new characteristics or change quantity
            if (productInCart.products.hasOwnProperty(productId)) {
                var productData = productInCart.products[productId];
                if (selectChar) {
                    var compareChar = [];
                    productData.personalValues.map(function (data) {
                        compareChar = array_diff(selectedCharacteristics, data.characteristics);
                        if (compareChar.length == 0) {
                            data.quantity++;
                            addNewCharacteristics = false;
                            isNew = false;
                        }
                    });
                    if (addNewCharacteristics) {
                        productData.personalValues.push({
                            "quantity": 1,
                            "characteristics": selectedCharacteristics,
                            "uniqueKey": uniqueKey
                        });
                        isNew = false;
                    }
                }

            }

            if (isNew) {
                productInCart.products[productId] = {
                    "name": productName,
                    "personalValues": [{
                        "quantity": 1,
                        "characteristics": selectedCharacteristics,
                        "uniqueKey": uniqueKey
                    }]
                };
            }

            if (isNew || addNewCharacteristics) {
                this.addProductToSmallCart(productId, productName, uniqueKey);
                this.increaseCounter();
            }

        } else {

            if (selectChar) {
                selectedCharacteristics = Cart.selectCharacteristics();
            }
            productInCart = {products: {}};
            productInCart.products[productId] = {
                "name": productName,
                "personalValues": [{
                    "quantity": 1,
                    "characteristics": selectedCharacteristics,
                    "uniqueKey": uniqueKey
                }]

            };

            this.addProductToSmallCart(productId, productName, uniqueKey);
            this.increaseCounter();
        }

        Cookie.set('productInCart', JSON.stringify(productInCart), {
            expires: Cart.cookieExpiresTime,
            path: '/'
        });

    },

    /**
     * Delete product form cart/basket
     * @param productId
     */
    delete:

        function (productId, uniqueKey) {

            var productInCart = Cookie.get('productInCart');

            if (productInCart) {
                productInCart = JSON.parse(productInCart);
                if (productInCart.products.hasOwnProperty(productId)) {
                    var productDetails = productInCart.products[productId];
                    productDetails.personalValues.map(function (product, i, arr) {
                        if (!product.uniqueKey.search(uniqueKey)) {
                            arr.splice(i, 1);
                            Cart.recountTotalPrice(0, product.quantity, uniqueKey);

                            Cart.decreaseCounter();
                            $('.cart_item[data-key="' + uniqueKey + '"]').remove();

                        }
                    });
                    if (productDetails.personalValues.length === 0) {
                        delete productInCart.products[productId];
                    }
                    if (Object.keys(productInCart.products).length == 0) {
                        Cookie.delete('productInCart');
                        return;
                    }

                    Cookie.set('productInCart', JSON.stringify(productInCart), {
                        expires: Cart.cookieExpiresTime,
                        path: '/'
                    });
                }
            }

        },

    /**
     * Change item quantity in cart/basket
     * @param obj
     * @param productId
     */
    chQuantity: function (obj, productId, uniqueKey) {
        var quantity = parseFloat($(obj).val());
        if (quantity > 0) {
            var productInCart = Cookie.get('productInCart');
            if (productInCart) {
                productInCart = JSON.parse(productInCart);
                var previousQuantity;
                if (productInCart.products.hasOwnProperty(productId)) {
                    var productDetails = productInCart.products[productId];
                    productDetails.personalValues.map(function (product, i, arr) {
                        if (!product.uniqueKey.search(uniqueKey)) {
                            previousQuantity = product.quantity;
                            product.quantity = quantity;

                        }
                    });

                    this.recountTotalPrice(previousQuantity, quantity, uniqueKey);
                    $('.cart_item[data-key="' + uniqueKey + '"]').find('.quantity').val(quantity);
                    Cookie.set('productInCart', JSON.stringify(productInCart), {
                        expires: Cart.cookieExpiresTime,
                        path: '/'
                    });
                }
            }
        }
    },

    /**
     * Recalculate total price in full cart/basket after delete product or change quantity
     * @param prevQuantity
     * @param quantity
     * @param uniqueKey
     */
    recountTotalPrice: function (prevQuantity, quantity, uniqueKey) {
        quantity = parseInt(quantity);
        var totalPrice = parseFloat($('#total_price').text());
        console.log(totalPrice, 'total price in begin');
        console.log(uniqueKey, 'uniqurKEy');
        if (totalPrice) {
            var productPrice = parseFloat($('.cart_item[data-key="' + uniqueKey + '"]').find('.product_price').text());
            if (prevQuantity > 0) {
                totalPrice -= productPrice * prevQuantity;
                totalPrice += productPrice * quantity;
                console.log(productPrice, 'in if');
            } else {
                totalPrice -= productPrice * quantity;
                console.log(productPrice * quantity, 'in else');
            }

            console.log(totalPrice, 'total price in end');
            $('#total_price').text(totalPrice.toFixed(2));
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
        var availableCharacteristics = $('.pd_characteristics .characteristic_group');
        var selectedCharacteristics = [];
        for (var i = 0; i < availableCharacteristics.length; i++) {
            var charType = $(availableCharacteristics[i]).attr('data-type');
            if (charType == 4 || charType == 5) {
                selectedCharacteristics.push($(availableCharacteristics[i]).find(':checked').attr('data-id'));
            }
        }
        return selectedCharacteristics;
    }
    ,
    smallOpenToggle: function () {
        $('#small_shop_cart').fadeToggle();
    }
    ,
};