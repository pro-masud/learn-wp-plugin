(function( $ ) {
	'use strict';

	jQuery(document).ready(function($) {
		var mediaUploader;
	
		$('#upload-slider-image').on('click', function(e) {
			e.preventDefault();
	
			if (mediaUploader) {
				mediaUploader.open();
				return;
			}
	
			mediaUploader = wp.media({
				title: 'Choose Image',
				button: { text: 'Select Image' },
				multiple: false
			});
	
			mediaUploader.on('select', function() {
				var attachment = mediaUploader.state().get('selection').first().toJSON();
				$('#slider-image').val(attachment.url);
				$('#slider-image-preview').attr('src', attachment.url).show();
				$('#remove-slider-image').show();
			});
	
			mediaUploader.open();
		});
	
		$('#remove-slider-image').on('click', function(e) {
			e.preventDefault();
			$('#slider-image').val('');
			$('#slider-image-preview').hide();
			$(this).hide();
		});
	});
	
	
})( jQuery );
