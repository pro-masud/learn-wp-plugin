;(function($) {
    $(document).ready(function() {

        $('table.wp-list-table.contacts').on('click', 'a.submitdelete', function(e){
            e.preventDefault();
            alert('Hello World');
        });
        
    });
})(jQuery);
