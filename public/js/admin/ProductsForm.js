var ProductsForm = {

    validate: function(){
        $('.field-error').removeClass('field-error');
        var requiredFields = $('input.input-required'),
            length = requiredFields.length,
            category,
            str;

        for(var i = 0; i < length; i++){
            str = $(requiredFields[i]).val();
            str = str.trim().search(/^.*\S/);
            if(str == -1){
                $(requiredFields[i]).addClass('field-error');
                showNotification($(requiredFields[i]).attr('data-error'), 'error');
                return 0;
            }
        }

        category = $('[name=category]').is(':checked');
        if(!category){
            showNotification('Выберите категорию', 'error');
        }

        return 1;

    },

    submit: function () {

       var validate = ProductsForm.validate();

       if(validate){
           $('#product-form').submit();
       }

    }

};