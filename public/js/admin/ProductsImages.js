var ProductsImages = {

    upload: function updateImageDisplay(e) {
        var files = e.target.files[0];
        if (files.type.match('image/jpeg') || files.type.match('image/gif') || files.type.match('image/png')) {
            var fr = new FileReader();
            fr.onload = function (e) {
                var canvas = document.getElementById('canvas-image');
                var context = canvas.getContext('2d');
                var imageObj = new Image();
                imageObj.onload = function () {
                    if (this.width > 800 || this.height > 800) {
                        if (this.width > this.height) {
                            canvas.width = 800;
                            canvas.height = this.height * (800 / this.width);
                            if (canvas.height > 800) {
                                canvas.width = this.width * (800 / this.height);
                                canvas.height = 800;
                            }
                        } else if(this.height > this.width) {
                            console.log('else if');
                            canvas.width = this.width * (800 / this.height);
                            canvas.height = 800;
                        }
                    }else{
                        console.log('else');
                        canvas.width = this.width;
                        canvas.height = this.height;
                    }


                    context.drawImage(this, 0, 0, canvas.width, canvas.height);
                    var imgUrl = canvas.toDataURL();

                    var thumb = $('.add-new');
                    thumb.find('i').remove();
                    var id = parseInt(thumb.attr('data-id'));
                    var idNext = id + 1;
                    var imgContainer = '<div class="thumb"></div>'
                    var img = "<img src='" + imgUrl + "'>";
                    var removeBtn = '<div class="remove-image" onclick="ProductsImages.remove(this)">' +
                        '<i class="fa fa-remove"></i>' +
                        '</div>';
                    var input = '<input class="upload-images" type="hidden" data-id="' + id + '" value="' + imgUrl + '" name="productImages[]">';
                    thumb.append(imgContainer);
                    thumb.find('.thumb').append(img).append(removeBtn);
                    thumb.removeClass('add-new');
                    var nexThumb = $('.pi-thumbnail').find('[data-id="' + idNext + '"]');
                    nexThumb.addClass('add-new');
                    nexThumb.append('<i class="fa fa-file-image-o"></i>');
                    $('#input-image').val('');
                    $('#product-form').append(input);
                };

                imageObj.src = e.target.result;
            };
            fr.readAsDataURL(files);
        } else {
            showNotification('Incorrect image type', 'error')
        }
    },
    //removing product image
    remove: function (obj) {
        event.stopPropagation();
        var id = parseInt($(obj).parent().parent().attr('data-id'));
        var thumbContainer = $('.pi-thumbnail'),
            thumbs = thumbContainer.find('div').length,
            nextId = id + 1,
            nextThumb = thumbContainer.find('[data-id=' + nextId + ']').find('.thumb');

        // if next container empty
        if (nextThumb.length == 0) {
            thumbContainer.find('.add-new').html('').removeClass('add-new');
            thumbContainer.find('[data-id=' + id + ']').html('<i class="fa fa-file-image-o"></i>')
                .addClass('add-new');
            return;
        }

        for (var i = id; i <= thumbs; i++) {
            nextId = i + 1;
            nextThumb = thumbContainer.find('[data-id=' + nextId + ']').find('.thumb');
            if(nextThumb.length == 0){
                thumbContainer.find('.add-new').html('').removeClass('add-new');
                thumbContainer.find('[data-id=' + i + ']').html('<i class="fa fa-file-image-o"></i>').addClass('add-new');
                return;
            }

            thumbContainer.find('[data-id=' + i + ']').html(thumbContainer.find('[data-id=' + nextId + ']').html())

        }
    }
};