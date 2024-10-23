;(function($){
    $('#mr9-enuiry-form form').on('submit', function(e){
        e.preventDefault();

        var data = $(this).serialize();

        $.post( MR9.ajaxurl, data, function( data ){

        })
        .fail(function(){
            
        })

    });
})(jQuery);