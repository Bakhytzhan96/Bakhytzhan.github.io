/**
 * Load media uploader on pages with our custom metabox
 */
jQuery(document).ready(function($){

	'use strict';

	// Instantiates the variable that holds the media library frame.
	var metaImageFrame;

	// Runs when the media button is clicked.
	$('body').on('click', '.btn_upload_image', function(e){

		e.preventDefault();
 
    	var button = $(this),
    		custom_uploader = wp.media({
			title: 'Custom Header Image',
			library : {
				// uncomment the next line if you want to attach image to the current post
				// uploadedTo : wp.media.view.settings.post.id, 
				type : 'image'
			},
			button: {
				text: 'Use this image' // button label text
			},
			multiple: false // for multiple image selection set to true
		}).on('select', function() { // it also has "open" and "close" events 
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />').next().val(attachment.id).next().show();
			
		})
		.open();

    });
    
    /*
	 * Remove image event
	 */
	$('body').on('click', '.btn_remove_image', function(){
		$(this).hide().prev().val('').prev().addClass('button').html('Upload Image');
		return false;
	});

});