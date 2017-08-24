let Gallery = function (imageContainer,thumbContainer) {

    if(imageContainer === 'undefined' || typeof imageContainer !== 'string'){
        console.log('imageContainer error');
        return;
    }

    this.imageContainer = document.getElementById(imageContainer);

    this.thumbContainer = thumbContainer;
    this.evenListners = [];

    this.showPopup = function () {

        var imageContainer = document.getElementById(imageContainer);
        var fullImage = imageContainer.querySelector('img');

        var galleryContainer = document.createElement('div');
        galleryContainer.id = 'galleryContainerOpened';

        galleryContainer.appendChild(fullImage);

        document.body.appendChild(galleryContainer);

    };

    this.imageContainer.onclick = this.showPopup;

    if(thumbContainer !== 'undefined' || typeof thumbContainer !== 'string'){

    }

};