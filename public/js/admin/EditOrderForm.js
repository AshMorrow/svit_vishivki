var EditOrderForm = {

    send: function () {
      EditOrderForm.getProducts();
      $('#order-form').submit();
    },

    getProducts: function () {
        var products = $('.order-product'),
        productsToSend = {};

        var id,
            uniqueKey,
            quantity,
            options,
            price;

        products.map(function (key) {
            id = $(products[key]).attr('data-id');
            uniqueKey = $(products[key]).attr('data-key');
            quantity = $(products[key]).attr('data-quantity');
            options = $(products[key]).attr('data-options');
            price = $(products[key]).attr('data-price');

            productsToSend[uniqueKey] = {
                id: id,
                quantity: quantity,
                options: options,
                price: price
            };
        });

        $('#order-products').val(JSON.stringify(productsToSend));
    },

    recount: function(key){
        var product = $('.order-product[data-key="'+key+'"]'),
            currentQuantity = parseInt($(product).find('.quantity').val());

        if( currentQuantity <= 0 ) return;

        var previousQuantity = parseInt($(product).attr('data-quantity')),
            price = parseFloat($(product).attr('data-price'),2),
            totalPrice = parseFloat($('#total-price').text(),2);

        totalPrice = (totalPrice - (previousQuantity * price)) + (currentQuantity * price);
        $(product).attr('data-quantity', currentQuantity);
        $('#total-price').text(totalPrice.toFixed(2));
    },

    remove: function (key) {
        var product = $('.order-product[data-key="'+key+'"]'),
            price = parseFloat($(product).attr('data-price'),2),
            quantity = parseInt($(product).attr('data-quantity')),
            totalPrice = parseFloat($('#total-price').text(),2);

        totalPrice = totalPrice - (quantity * price);

        $(product).remove();
        $('#total-price').text(totalPrice.toFixed(2));
    }

};