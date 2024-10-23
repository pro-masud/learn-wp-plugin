;(function($) {
    $(document).ready(function() {

        $('table.wp-list-table.contacts').on('click', 'a.submitdelete', function(e){
            e.preventDefault();
           
            if( !confirm(MR.confirm)) {
                return;
            }
    
            var self = $(this),
                id = self.data('id');
    
    
            wp.ajax.send('mr9_delete_contact', {
                data: {
                    id: id,
                    _wpnonce: MR.nonce
                }
               
            }).
            done(function(response){

                self.closest('tr')
                .css('background-color', 'red')
                .hide(400, function(){
                    $(this).remove();
                });
            })
            .fail(function(){
                alert(MR.error);
            });
        });
        
    });
})(jQuery);