;(function ($) {
    "use strict";

    // Check if jQuery is loaded
    if (typeof jQuery === 'undefined') {
        console.error("jQuery is not loaded. Please make sure it is included before this script.");
        return;
    }

    $(document).ready(function() {

        // Check if Magnific Popup is loaded
        if (typeof $.fn.magnificPopup === 'undefined') {
            console.error("Magnific Popup library is not loaded. Please include it before this script.");
            return;
        }

        // Image Popup Configuration
        const initImagePopup = () => {
            if ($('.image-popup').length) {
                $('.image-popup').magnificPopup({
                    type: 'image',
                    removalDelay: 300,
                    mainClass: 'mfp-with-zoom',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        easing: 'ease-in-out',
                        opener: function(openerElement) {
                            return openerElement.is('img') ? openerElement : openerElement.find('img');
                        }
                    }
                });
            } else {
                console.warn("No .image-popup elements found.");
            }
        };

        // Video Popup Configuration
        const initVideoPopup = () => {
            if ($('.popup-youtube, .popup-vimeo, .popup-gmaps').length) {
                $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                });
            } else {
                console.warn("No video popup elements found (.popup-youtube, .popup-vimeo, .popup-gmaps).");
            }
        };

        // Initialize both image and video popups
        initImagePopup();
        initVideoPopup();

    });

})(jQuery);
