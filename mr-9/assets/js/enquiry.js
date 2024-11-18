;(function($){
    $('#mr9-enuiry-form form').on('submit', function(e){
        e.preventDefault();

        var data = $(this).serialize();

        // console.log(data);

        $.post( MR9.ajaxurl, data, function( response ){

            if( response.success){
                alert(response.success);
            }{
                alert(response.data.message);
            }

        })
        .fail(function(){
            alert(MR9.error);
        });

        

    });
})(jQuery);