;(function($){
    $('#mr9-enuiry-form form').on('submit', function(e){
        e.preventDefault();

        var data = serialize();

        $.post( '', {paran1: 'value1'}, function(data, textStatus, xhr){
            
        });

    });
})(jQuery);