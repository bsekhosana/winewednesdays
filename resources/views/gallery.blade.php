<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/simplelightbox.min.css') }}">
</head>
<body onload="fetchGalleryImages('48 GIN Bernini');">

<div class="gallery" id="gallery-images">
</div>

<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/simple-lightbox.min.js') }}"></script>

<script type="text/javascript">

    function fetchGalleryImages(folder) {
        $.ajax({
        type: 'GET', //THIS NEEDS TO BE GET
        url: '{{ url('/get-images') }}/'+folder,
        dataType: 'json',
        success: function (data) {

        var slideInnerHtml = '';

        $.each(data, function(index, item) {
            slideInnerHtml += '<a href="'+ data[index] +'" class="big" hidden> <img src="'+ data[index] +'" alt="" title=""></img></a>';
        });

        $('#gallery-images').html(slideInnerHtml);

        var gallery = $('.gallery a').simpleLightbox();

            gallery.open();

            gallery.on('close.simplelightbox', function () {
                parent.closeIFrame();
            });

            gallery({

                    // default source attribute
                    sourceAttr: 'href',

                    // shows fullscreen overlay
                    overlay:    true,

                    // shows loading spinner
                    spinner:    true,

                    // shows navigation arrows
                    nav:      true,

                    // text for navigation arrows
                    navText:    ['&larr;','&rarr;'],

                    // shows image captions
                    captions:   true,
                    captionDelay:   0,
                    captionSelector:  'img',
                    captionType:    'attr',
                    captionPosition:  'bottom',
                    captionClass: '',

                    // captions attribute (title or data-title)
                    captionsData: 'title',

                    // shows close button
                    close:      true,

                    // text for close button
                    closeText:    'X',

                    // swipe up or down to close gallery
                    swipeClose: true,

                    // show counter
                    showCounter:  true,

                    // file extensions
                    fileExt:    'png|jpg|jpeg|gif',

                    // weather to slide in new photos or not, disable to fade
                    animationSlide:   true,

                    // animation speed in ms
                    animationSpeed: 250,

                    // image preloading
                    preloading:   true,

                    // keyboard navigation
                    enableKeyboard: true,

                    // endless looping
                    loop:     true,

                    // group images by rel attribute of link with same selector
                    rel: false,

                    // closes the lightbox when clicking outside
                    docClose:     true,

                    // how much pixel you have to swipe
                    swipeTolerance: 50,

                    // lightbox wrapper Class
                    className:    'simple-lightbox',

                    // width / height ratios
                    widthRatio:   0.8,
                    heightRatio:  0.9,

                    // scales the image up to the defined ratio size
                    scaleImageToRatio: false,

                    // disable right click
                    disableRightClick:  false,

                    // disable page scroll
                    disable:    true,

                // show an alert if image was not found
                alertError:     true,

                // alert message
                alertErrorMessage:  'Image not found, next image will be loaded',

                // additional HTML showing inside every image
                additionalHtml:   false,

                // enable history back closes lightbox instead of reloading the page
                history: true,

                // time to wait between slides
                throttleInterval: 0,

                // Pinch to <a href="https://www.jqueryscript.net/zoom/">Zoom</a> feature for touch devices
                doubleTapZoom: 2,
                maxZoom: 10

        });


         console.log(slideInnerHtml);


        },error:function(){
        console.log(data);
        }
        });
    }

</script>
</body>
</html>