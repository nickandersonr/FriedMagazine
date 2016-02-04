//Themerex Banner Admin JS

jQuery(document).ready(function(){	

	/* Filed Type DatePicker */

	if(jQuery('input.datepicker').length > 0) {
		jQuery('input.datepicker').datepicker();
	}

	/* Filed Type Slider */

	if(jQuery('.ui-slider').length > 0) {

		var slider_block = {};
		jQuery('.ui-slider').each(function(){
			var th = jQuery(this),
				slider_id = th.attr('id');
			slider_block[slider_id] = th.slider({
				'min' : jQuery(this).data('min'),
				'max' : jQuery(this).data('max'),
				value: jQuery(this).data('val') != 'auto' ? jQuery(this).data('val') : '',
				slide: function(event, ui) {
					var input_id = th.attr('id').replace('_slider', '');
					jQuery('#'+input_id).val(ui.value);
					jQuery('#'+input_id+'_display').html(ui.value);
				}
			});
		});

		jQuery('.button.set_auto').click(function(){
			var auto_val = jQuery(this).data('auto'),
				parent_slide = jQuery(this).parent().find('input').attr('id') + '_slider';

			jQuery(this).parent().find('input').val(auto_val);
			jQuery(this).parent().find('.slider_val_display').html(auto_val);

			slider_block[parent_slide].slider({value: 0});

			return false;
		});
	}

	if(jQuery('#banner_hover_image').length > 0) {

		jQuery('#banner_hover_image').change(function(){
			var th = jQuery(this),
				th_val = th.val(),
				th_id = th.attr('id'),
				holder = jQuery('#' + th_id + '_holder');
			holder.find('.holder_inner').html('<img src="' + th_val + '" />');
			holder.find('.holder_remove_image').addClass('button_show');
		});
		jQuery('#banner_hover_image_holder .holder_remove_image').click(function(){
			var th = jQuery(this),
				parent = th.parent();
			th.removeClass('button_show');
			parent.find('.holder_inner').html('');
			jQuery('#banner_hover_image').val('');
			return false;
		});

	}

});

// Media manager handler
var media_frame = null;
var media_link = '';
function showMediaManager(el, hideType) {
	"use strict";

	media_link = jQuery(el);
	// If the media frame already exists, reopen it.
	if ( media_frame ) {
		media_frame.open();
		return false;
	}

	// Create the media frame.
	media_frame = wp.media({
		// Set the title of the modal.
		title: media_link.data('choose'),
		// Multiple choise
		multiple: media_link.data('multiple') === true ? 'add' : false,
		// Customize the submit button.
		button: {
			// Set the text of the button.
			text: media_link.data('update'),
			// Tell the button not to close the modal, since we're
			// going to refresh the page when the image is selected.
			close: true
		}
	});

	// When an image is selected, run a callback.
	media_frame.on( 'select', function() {
		"use strict";
		// Grab the selected attachment.
		var field = jQuery("#"+media_link.data('linked-field')).eq(0);
		var attachment = '';
		if (media_link.data('multiple')==true) {
			media_frame.state().get('selection').map( function( att ) {
				attachment += (attachment ? "\n" : "") + att.toJSON().url;
			});
			var val = field.val();
			attachment = val + (val ? "\n" : '') + attachment;
		} else {
			attachment = media_frame.state().get('selection').first().toJSON().url;
		}
		field.val(attachment);
		field.trigger('change');
	});

	// Finally, open the modal.
	media_frame.open();
	return false;
}