/* ---------------------------------------------
 common scripts
 --------------------------------------------- */

 ;(function ($) {
    "use strict"; // use strict to start

    $(document).ready(function () {

        /* ---------------------------------------------
         portfolio filtering
         --------------------------------------------- */

        var $portfolio = $('.portfolio-grid');
        if ($.fn.imagesLoaded && $portfolio.length > 0) {
            imagesLoaded($portfolio, function () {
                if ($.fn.isotope) {
                    $portfolio.isotope({
                        itemSelector: '.portfolio-item',
                        filter: '*'
                    });
                    $(window).trigger("resize");
                } else {
                    console.warn("Isotope library is not loaded.");
                }
            });
        }

        $('.portfolio-filter').on('click', 'a', function (e) {
            e.preventDefault();
            $(this).parent().addClass('active').siblings().removeClass('active');
            var filterValue = $(this).attr('data-filter');
            if ($portfolio.length && $.fn.isotope) {
                $portfolio.isotope({filter: filterValue});
            } else {
                console.warn("Portfolio or Isotope not available for filtering.");
            }
        });

        var $loadbutton = $('.loadAjax');

        if ($loadbutton.length && typeof galleryloadajax !== 'undefined') {

            // When default max pages 1 remove load more button
            if (galleryloadajax.max_pages == 1) {
                $loadbutton.remove();
            }

            $loadbutton.on('click', function () {

                var $button = $(this),
                    $data;

                $data = {
                    'action': 'loadmore',
                    'query': galleryloadajax.posts,
                    'page': galleryloadajax.current_page,
                    'postNumber': galleryloadajax.postNumber,
                    'col': galleryloadajax.col
                };

                $.ajax({
                    url: galleryloadajax.action_url,
                    data: $data,
                    type: 'POST',
                    beforeSend: function (xhr) {
                        $button.text(galleryloadajax.btnLodingLabel);
                    },
                    success: function (data) {
                        var $dataload = $('.dataload'),
                            $portfolioItems = $dataload.parent('.portfolio--items');
                        if (data) {
                            // insert new posts
                            $dataload.before(data);
                            // increment page
                            galleryloadajax.current_page++;

                            if ($portfolioItems.length && $.fn.isotope) {
                                setTimeout(function () {
                                    $portfolioItems.isotope('reloadItems').isotope({
                                        animationEngine: 'best-available',
                                        itemSelector: '.portfolio--item'
                                    });
                                }, 300);
                            } else {
                                console.warn("No portfolio items found to reload or Isotope not available.");
                            }
                            // Change Button text From loading
                            $button.text(galleryloadajax.btnLabel);

                            // if last page, remove the button
                            if (galleryloadajax.current_page == galleryloadajax.max_pages) {
                                $button.remove();
                            }

                        } else {
                            // if no data, remove the button as well
                            $button.remove();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error:", status, error);
                    }
                });

                return false;
            });
        } else {
            console.warn("Load button or galleryloadajax is not available.");
        }
    });

})(jQuery);