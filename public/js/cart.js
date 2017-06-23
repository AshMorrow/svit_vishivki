var Cart = new function () {

    this.increaseCounter = function () {
        $('#top_cart .cart_item_counter').text(function (index, value) {
            return parseInt(value) + 1;
        })
    };

    this.add = function (productId) {
        if (typeof(productId) != 'number') return;

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
                    "quantity": 1
                });

                this.increaseCounter();
            }

        } else {
            productInCart = {
                "items": [{
                    "id": productId,
                    "quantity": 1
                }]

            }

            this.increaseCounter();
        }

        Cookie.set('productInCart', JSON.stringify(productInCart), {
            expires: 3600,
            path: '/'
        });

    }

};