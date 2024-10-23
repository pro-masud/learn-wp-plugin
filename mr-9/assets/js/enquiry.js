;(function($){
    $('#mr9-enuiry-form form').on('submit', function(e){
        e.preventDefault();

        var data = $(this).serialize();

        console.log(data);

        $.post( MR9.ajaxurl, data, function( data ){

        })
        .fail(function(){
            alert('Something went wrong');
        })

    });
})(jQuery);