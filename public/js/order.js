var Order = {
    changeDeliveryType: function () {
        var type = $('#o_delivery_type').val();
        switch (type) {
            case '1':
                $('#o_delivery_address_container').fadeOut();
                $('#o_new_post_container').fadeOut();
                break;
            case '2':
                $('#o_delivery_address_container').fadeIn();
                $('#o_new_post_container').fadeOut();
                break;

            case '3':
                $('#o_delivery_address_container').fadeOut();
                $('#o_new_post_container').fadeIn();
        }
    }
};