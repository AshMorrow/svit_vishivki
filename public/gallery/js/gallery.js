let Gallery = function (imageContainer, thumbContainer) {

    var galleryMainContext = this;

    if (imageContainer === 'undefined' || typeof imageContainer !== 'string') {
        console.log('imageContainer error');
        return;
    }

    this.imageContainer = document.getElementById(imageContainer);
    this.images = this.imageContainer.getElementsByTagName('IMG');
    this.evenListners = [];

    this.showPopup = function () {

        if (document.getElementById('galleryContainerOpened')) return;
        document.body.style = 'overflow: hidden';

        var galleryContainer = document.createElement('div');
        galleryContainer.id = 'galleryContainerBackground';

        var galleryElementsContainer = document.createElement('div');
        galleryElementsContainer.id = 'galleryElementsContainer';

        /**
         * Creating head/top part of modal window
         */
        var topContainer = document.createElement('div');
        topContainer.className = 'galleryTopContainer';

        var topLabel = document.createElement('div');
        topLabel.className = 'galleryTopLabel';

        var topLabelText = document.createElement('span');
        topLabelText.textContent = document.getElementById('productLabel').innerText;

        var topCloseBtnContainer = document.createElement('div');
        topCloseBtnContainer.className = 'galleryTopBtnContainer';
        topCloseBtnContainer.textContent = '';

        /**
         * Creating elements of content
         */

        var galleryContentContainer = document.createElement('div');
        galleryContentContainer.className = 'galleryContentContainer';

        var contentPhotoContainer = document.createElement('div');
        contentPhotoContainer.className = 'galleryContentPhotoContainer';

        /**
         *  Creating thumbnail elements
         */

        var galleryThumbnailConatiner = document.createElement('div');
        galleryThumbnailConatiner.className = 'galleryThumbnailContainer';

        /**
         * Appending top elements
         */
        topLabel.appendChild(topLabelText);
        topContainer.appendChild(topLabel);
        topContainer.appendChild(topCloseBtnContainer);
        galleryElementsContainer.appendChild(topContainer);

        /**
         * Appending content elements
         */

        $(contentPhotoContainer).append($(galleryMainContext.imageContainer).find('img').clone());
        galleryContentContainer.appendChild(contentPhotoContainer);
        galleryElementsContainer.appendChild(galleryContentContainer);

        for (var i = 0; i < galleryMainContext.thumbImageCntainer.length; i++) {
            $(galleryThumbnailConatiner).append($(galleryMainContext.thumbImageCntainer[i]).clone())
        }

        galleryContentContainer.appendChild(galleryThumbnailConatiner);

        galleryContainer.appendChild(galleryElementsContainer);

        document.body.appendChild(galleryContainer);

        /**
         * Navigation in modal
         */

        $('#galleryElementsContainer .galleryThumbnailContainer').find('.gallery_thumbs').mouseover(function () {
            if (this.className.search(/active/i) >= 0) {
                return;
            } else {
                this.thumbDataIndex = $(this).attr('data-slide-index');
                this.modalPhotoContainer = $('#galleryElementsContainer .galleryContentPhotoContainer');
                this.modalPhotoContainer.find('img').removeClass('active');
                this.modalPhotoContainer.find('img[data-index = ' + this.thumbDataIndex + ']').addClass('active')

                $(this).parent().find('.active').removeClass('active');
                $(this).addClass('active');

            }
        });

        /**
         * Event action functions
         */
        function close() {
            console.log('popup closed');
            document.body.style = '';
            $(galleryContainer).fadeOut('fast',function () {
                galleryContainer.remove()
            });

        }

        function nextImage() {
            var nextIndex = parseInt($('#galleryElementsContainer .galleryContentPhotoContainer').find('.active').attr('data-index')) + 1;
            var nextThumb = $('#galleryElementsContainer .galleryContentPhotoContainer').find('img[data-index='+ nextIndex +']');
            if(nextThumb.length){
                $('#galleryElementsContainer .galleryContentPhotoContainer').find('.active').removeClass('active');
                nextThumb.addClass('active');

                $('#galleryElementsContainer .galleryThumbnailContainer').find('.active').removeClass('active');
                $('#galleryElementsContainer .galleryThumbnailContainer').find('.gallery_thumbs[data-slide-index='+ nextIndex +']').addClass('active');
            }
        }

        function prevImage() {
            var prevIndex = parseInt($('#galleryElementsContainer .galleryContentPhotoContainer').find('.active').attr('data-index')) - 1;
            var prevThumb = $('#galleryElementsContainer .galleryContentPhotoContainer').find('img[data-index='+ prevIndex +']');
            if(prevThumb.length){
                $('#galleryElementsContainer .galleryContentPhotoContainer').find('.active').removeClass('active');
                prevThumb.addClass('active');

                $('#galleryElementsContainer .galleryThumbnailContainer').find('.active').removeClass('active');
                $('#galleryElementsContainer .galleryThumbnailContainer').find('.gallery_thumbs[data-slide-index='+ prevIndex +']').addClass('active');
            }
        }

        /**
         * events initialization
         */

        $('#galleryElementsContainer').on('click',function(e){
            e.stopPropagation();
        });

        var events = [];

        events['close'] = galleryContainer.addEventListener('click', close);
        events['closeBtn'] = topCloseBtnContainer.addEventListener('click', close);
        events['rightArrow'] = document.addEventListener('keydown', function (e) {
            if(e.keyCode == 39){
                nextImage();
            }else if(e.keyCode == 37){
                prevImage();
            }else if(e.keyCode == 27){
                close();
            }
        })


    };

    this.evenListners['open'] = this.imageContainer.addEventListener('click', this.showPopup);


    /**
     * Creating action for thumbs
     */

    if (thumbContainer !== 'undefined' && typeof thumbContainer === 'string') {

        this.thumbContainer = document.getElementById(thumbContainer);
        if (this.thumbContainer) {

            this.thumbImageCntainer = this.thumbContainer.getElementsByClassName('gallery_thumbs');
            this.thumbImageCntainerEvents = this.thumbImageCntainer;

            for (var i = 0; i < this.thumbImageCntainer.length; i++) {
                this.thumbImageCntainerEvents[i].addEventListener('mouseover', function () {
                    if (this.className.search(/active/i) >= 0) {
                        return;
                    } else {
                        $(galleryMainContext.thumbContainer).find('.active').removeClass('active');
                        $(this).addClass('active');
                        this.thumbDataIndex = $(this).attr('data-slide-index');

                        $(galleryMainContext.imageContainer).find('img').removeClass('active');
                        $(galleryMainContext.imageContainer).find('img[data-index = ' + this.thumbDataIndex + ']').addClass('active')

                    }
                });
                this.thumbImageCntainerEvents[i].addEventListener('click', galleryMainContext.showPopup);
            }

        } else {
            console.log('thumb container not found');
        }

    }

};