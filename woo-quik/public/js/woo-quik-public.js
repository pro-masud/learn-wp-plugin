(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$('.woo-quick-view-btn').on( 'click', function(e){
		e.preventDefault();

		$('.woo-quik-view-model').show();
		let wqv = $(this).data('id');
		alert( wqv );

		$.ajax({
			url:woo_quik_view.ajaxurl,
			method:"POST",
			dataType:"html",
			data: {
				action: "woo_quik_view_callback",
				'qpid':wqv,
			},
			success:function(res){
				$('.woo-modal-content').html(res);
			}
		});
	});

	$('#woo-modal-close').on( 'click', function(e){
		e.preventDefault();
		
		$('.woo-quik-view-model').hide();
	});

})( jQuery );
