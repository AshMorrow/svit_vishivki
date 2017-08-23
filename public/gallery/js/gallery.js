let Gallery = function (imageContainer,thumbContainer) {
    console.log('d');
    this.imageContainer = imageContainer;
    this.thumbContainer = thumbContainer;
    this.evenListners = [];

    this.showPopup = function () {

        $('body').append('<div class="b_gallery"></div>')

    };

    if(this.imageContainer === 'undefined' || typeof this.imageContainer !== 'string'){
        console.log('imageContainer error');
        return;
    }
    console.log(this.imageContainer);
    console.log(typeof this.imageContainer);
    console.log(imageContainer);



    if(thumbContainer !== 'undefined' || typeof thumbContainer !== 'string'){

    }

};