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

    addProductToSmallCart: function (productId, productName) {
        console.log('product');
        var mainContainer = document.createElement('div');
        mainContainer.className = 'sh_item';
        mainContainer.setAttribute('data-product-id', productId);
        mainContainer.innerHTML = `
            <div class="sh_image_container">
                <img src="storage/productImages/thumbs/${productId}/1.jpg">
            </div>
            <div class="sh_item_information">
                <div class="item_name">${productName}</div>
                <div class="sh_item_quantity">
                    <input type="text" value="1" data-product-id=${productId} onchange="Cart.chQuantity(this)">
                </div>
            </div>
            <div class="sh_remove_item" onclick="Cart.delete(this)">
               <span data-icon="f"></span>
            </div>`;

        $('#small_shop_cart .sh_items').append(mainContainer);
    },

    add: function (productId, productName) {
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

    show: function () {


        var mainContainer = document.createElement('div');
        mainContainer.className = 'small_cart_full';


    },

    delete: function (obj){

        var container = $(obj).parent();
        var productId = container.attr('data-product-id');
        var productInCart = Cookie.get('productInCart');

        if (productInCart) {
            productInCart = JSON.parse(productInCart);
            console.log(productInCart.items[0]);
            productInCart.items.map(function (product,i,arr) {

                if (product.id == productId) {
                    arr.splice(i, 1);
                }
            });

            if(productInCart.items.length){
                Cookie.set('productInCart', JSON.stringify(productInCart), {
                    expires: 3600,
                    path: '/'
                });
            }else{
               Cookie.delete('productInCart');
            }

        }
        this.decreaseCounter();
        container.remove();

    },

    chQuantity: function (obj) {
        var quantity = parseInt($(obj).val());
        if (quantity > 0) {
            var productId = $(obj).attr('data-product-id');
            var productInCart = Cookie.get('productInCart');
            if (productInCart) {
                productInCart = JSON.parse(productInCart);
                productInCart.items.map(function (product) {
                    if (product.id == productId) {
                        product.quantity = quantity;
                    }
                });

                Cookie.set('productInCart', JSON.stringify(productInCart), {
                    expires: 3600,
                    path: '/'
                });
            }
        }
    },

    smallOpenToggle: function(){

        $('#small_shop_cart').fadeToggle();

    },

};