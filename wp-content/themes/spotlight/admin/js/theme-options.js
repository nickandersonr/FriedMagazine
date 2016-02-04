// ThemeREX Options scripts
jQuery(document).ready(function(){
	"use strict";

	
	// Init fields and groups
	//----------------------------------------------------------------
	themerex_options_init(jQuery('.themerex_options_body'));

	
	// Save options
	//----------------------------------------------------------------
	jQuery('.themerex_options').on('click', '.themerex_options_button_save', function (e) {
		"use strict";
		//themerex_message_info('', THEMEREX_OPTIONS_STRINGS_wait);
		// Save editors content
		if (typeof(tinymce) != 'undefined') {
			var editor = tinymce.activeEditor;
			if (editor !== null && 'mce_fullscreen' == editor.id )
				tinymce.get('content').setContent(editor.getContent({format : 'raw'}), {format : 'raw'});
			tinymce.triggerSave();
		}
		// Prepare data
		var data = {
			action: 'themerex_options_save',
			nonce: THEMEREX_OPTIONS_ajax_nonce,
			data: jQuery(".themerex_options_form").serialize(),
			mode: "save"
		};
		jQuery.post(THEMEREX_OPTIONS_ajax_url, data, function(response) {
			"use strict";
			themerex_message_success('', THEMEREX_OPTIONS_STRINGS_save_options);
		});
		e.preventDefault();
		return false;
	});

	
	// Reset options
	//----------------------------------------------------------------
	jQuery('.themerex_options').on('click', '.themerex_options_button_reset', function (e) {
		"use strict";
		themerex_message_confirm(THEMEREX_OPTIONS_STRINGS_reset_options_confirm, THEMEREX_OPTIONS_STRINGS_reset_options, function(btn) {
			"use strict";
			if (btn != 1) return;
			//themerex_message_info('', THEMEREX_OPTIONS_STRINGS_wait);
			var data = {
				action: 'themerex_options_save',
				nonce: THEMEREX_OPTIONS_ajax_nonce,
				mode: "reset"
			};
			jQuery.post(THEMEREX_OPTIONS_ajax_url, data, function(response) {
				"use strict";
				themerex_message_success('', THEMEREX_OPTIONS_STRINGS_reset_options);
			});
			
		});
		e.preventDefault();
		return false;
	});
});


// Init all elements
//-----------------------------------------------------------------
var THEMEREX_OPTIONS_BODY = null;
function themerex_options_init(to_body) {
	
	THEMEREX_OPTIONS_BODY = to_body;
	
	// Pretty Photo init
	//----------------------------------------------------------------
	prettyPhotoInit(to_body);


	// Tabs and partitions init
	//----------------------------------------------------------------
	to_body.find('.themerex_options_tab,.themerex_options_partition').tabs({
		// Init options, which depends from width() or height() only after open it's parent tab or partition
		create: function (e, ui) {
			if (ui.panel) {
				themerex_options_init_hidden_elements(ui.panel);
			}
		},
		activate: function (e, ui) {
			if (ui.newPanel) {
				themerex_options_init_hidden_elements(ui.newPanel);
			}
		}
	});
	to_body.find('.themerex_options_tab > ul,.themerex_options_partition > ul').sortable().disableSelection();


	// Accordion init
	//----------------------------------------------------------------
	to_body.find('.themerex_options_accordion').accordion({
		header: ".themerex_options_accordion_header",
		collapsible: true,
		heightStyle: "content",
		// Init options, which depends from width() or height() only after open it's parent accordion
		create: function (e, ui) {
			if (ui.panel) {
				themerex_options_init_hidden_elements(ui.panel);
			}
		},
		activate: function (e, ui) {
			if (ui.newPanel) {
				themerex_options_init_hidden_elements(ui.newPanel);
			}
		}
	});
	to_body.find('.themerex_options_accordion').sortable().disableSelection();


	// Toggles
	//----------------------------------------------------------------
	to_body.on('click', '.themerex_options_toggle .themerex_options_toggle_header', function () {
		"use strict";
		if (jQuery(this).hasClass('ui-state-active')) {
			jQuery(this).removeClass('ui-state-active');
			jQuery(this).siblings('div').slideUp();
		} else {
			jQuery(this).addClass('ui-state-active');
			jQuery(this).siblings('div').slideDown();
			themerex_options_init_hidden_elements(jQuery(this));
		}
	});
	/*
	to_body.sortable({
		items: '.themerex_options_toggle'
	});	//.disableSelection();
	*/


	// Masked input init
	//----------------------------------------------------------------
	to_body.find('.themerex_options_input_masked').each(function () {
		"use strict";
		jQuery(this).mask(''+jQuery(this).data('mask'));
	});


	// Datepicker init
	//----------------------------------------------------------------
	to_body.find('.themerex_options_input_date').each(function () {
		"use strict";
		var linked = jQuery(this).data('linked-field');
		var curDate = linked ? jQuery('#'+linked).val() : jQuery(this).val();
		jQuery(this).datepicker({
			dateFormat: jQuery(this).data('format'),
			numberOfMonths: jQuery(this).data('months'),
			gotoCurrent: true,
			changeMonth: true,
			changeYear: true,
			defaultDate: curDate,
			onSelect: function (text, ui) {
				var linked = jQuery(this).data('linked-field');
				if (!empty(linked)) {
					jQuery('#'+linked).val(text).trigger('change');
				} else {
					ui.input.trigger('change');
				}
			}
		});
	});


	// Spinner arrows click
	//----------------------------------------------------------------
	to_body.on('click', '.themerex_options_field_spinner .themerex_options_arrow_up,.themerex_options_field_spinner .themerex_options_arrow_down', function () {
		"use strict";
		var field = jQuery(this).parent().siblings('input');
		var inc = (jQuery(this).hasClass('themerex_options_arrow_up') ? 1 : -1) * Math.max(1, isNaN(field.data('increment')) ? 1 : field.data('increment'));
		var minValue = field.data('min');
		var maxValue = field.data('max');
		var newValue = isNaN(field.val()) ? 0 : Number(field.val()) + inc;
		if (!isNaN(maxValue) && newValue > maxValue) {
			newValue = maxValue;
		}
		if (!isNaN(minValue) && newValue < minValue) {
			newValue = minValue;
		}
		field.val(newValue);
	});

	
	// Tags
	//----------------------------------------------------------------
	to_body.find('.themerex_options_field_tags .themerex_options_field_content').sortable({
		items: "span",
		update: function(event, ui) {
			var tags = '';
			ui.item.parent().find('.themerex_options_tag').each(function() {
				tags += (tags ? THEMEREX_OPTIONS_delimiter : '') + jQuery(this).text();
			});
			ui.item.siblings('input[type="hidden"]').eq(0).val(tags).trigger('change');
		}
	}).disableSelection();
	to_body.on('keypress', '.themerex_options_field_tags input[type="text"]', function (e) {
		"use strict";
		if (e.which===44) {
			addTagInList(jQuery(this));
			e.preventDefault();
			return false;
		}
	});
	to_body.on('keydown', '.themerex_options_field_tags input[type="text"]', function (e) {
		"use strict";
		if (e.which===13) {
			addTagInList(jQuery(this));
			e.preventDefault();
			return false;
		}
	});
	function addTagInList(obj) {
		"use strict";
		if (obj.val().trim()!='') {
			var text = obj.val().trim();
			obj.before('<span class="themerex_options_tag iconadmin-cancel">'+text+'</span>');
			var tags = obj.next().val();
			obj.next().val(tags + (tags ? THEMEREX_OPTIONS_delimiter : '') + text).trigger('change');
			obj.val('');
		}
	}
	to_body.on('click', '.themerex_options_field_tags .themerex_options_field_content span', function (e) {
		"use strict";
		var text = jQuery(this).text();
		var tags = jQuery(this).siblings('input[type="hidden"]').eq(0).val()+THEMEREX_OPTIONS_delimiter;
		tags = tags.replace(text+THEMEREX_OPTIONS_delimiter, '');
		tags = tags.substring(0, tags.length-1);
		jQuery(this).siblings('input[type="hidden"]').eq(0).val(tags).trigger('change');
		jQuery(this).siblings('input[type="text"]').focus();
		jQuery(this).remove();
		e.preventDefault();
		return false;
	});
	to_body.on('click', '.themerex_options_field_tags .themerex_options_field_content', function (e) {
		"use strict";
		jQuery(this).find('input[type="text"]').focus();
		e.preventDefault();
		return false;
	});

	
	// Checkbox
	//----------------------------------------------------------------
	to_body.on('change', '.themerex_options_field_checkbox input', function (e) {
		"use strict";
		jQuery(this).next('label').eq(0).toggleClass('themerex_options_state_checked');
		e.preventDefault();
		return false;
	});


	// Radio button
	//----------------------------------------------------------------
	to_body.on('change', '.themerex_options_field_radio input', function (e) {
		"use strict";
		jQuery(this).parent().parent().find('label').removeClass('themerex_options_state_checked').find('span').removeClass('iconadmin-dot-circled');
		jQuery(this).parent().parent().find('input:checked').next('label').eq(0).addClass('themerex_options_state_checked').find('span').addClass('iconadmin-dot-circled');
		jQuery(this).parent().parent().find('input[type="hidden"]').val(jQuery(this).parent().parent().find('input:checked').val());
		e.preventDefault();
		return false;
	});


	// Switch button
	//----------------------------------------------------------------
	to_body.on('click', '.themerex_options_field_switch .themerex_options_switch_inner', function (e) {
		"use strict";
		var val = parseInt(jQuery(this).css('marginLeft'))==0 ? 2 : 1;
		var data = jQuery(this).find('span').eq(val-1).data('value');
		jQuery(this).parent().siblings('input[type="hidden"]').eq(0).val(data).trigger('change');
		jQuery(this).parent().toggleClass('themerex_options_state_off', val==2)
		e.preventDefault();
		return false;
	});


	// Checklist
	//----------------------------------------------------------------
	to_body.on('click', '.themerex_options_field_checklist .themerex_options_listitem', function (e) {
		"use strict";
		var multiple = jQuery(this).parents('.themerex_options_field_checklist').hasClass('themerex_options_multiple');
		if (!multiple) {
			jQuery(this).siblings('.themerex_options_listitem').removeClass('themerex_options_state_checked');
		}
		jQuery(this).toggleClass('themerex_options_state_checked');
		collectCheckedItems(jQuery(this).parent());
		e.preventDefault();
		return false;
	});
	to_body.find('.themerex_options_field_checklist.themerex_options_multiple .themerex_options_field_content').sortable({
		update: function(event, ui) {
			"use strict";
			collectCheckedItems(ui.item.parent());
		}
	}).disableSelection();


	// Select, list, images, icons, fonts
	//----------------------------------------------------------------
	to_body.on('click', '.themerex_options_field_select .themerex_options_input,.themerex_options_field_select .themerex_options_field_after,.themerex_options_field_images .themerex_options_caption_image,.themerex_options_field_icons .themerex_options_caption_icon', function (e) {
		"use strict";
		jQuery(this).siblings('.themerex_options_input_menu').slideToggle();
		e.preventDefault();
		return false;
	});

	to_body.on('click', '.themerex_options_field .themerex_options_menuitem', function (e) {
		"use strict";
		var multiple = jQuery(this).parents('.themerex_options_field').hasClass('themerex_options_multiple');
		if (!multiple) {
			jQuery(this).siblings('.themerex_options_menuitem').removeClass('themerex_options_state_checked');
			jQuery(this).addClass('themerex_options_state_checked');
		} else {
			jQuery(this).toggleClass('themerex_options_state_checked');
		}
		collectCheckedItems(jQuery(this).parent());
		if (!multiple && !jQuery(this).parent().hasClass('themerex_options_input_menu_list'))
			jQuery(this).parent().slideToggle();
		e.preventDefault();
		return false;
	});

	to_body.find('.themerex_options_field.themerex_options_multiple .themerex_options_input_menu').sortable({
		update: function(event, ui) {
			"use strict";
			collectCheckedItems(ui.item.parent());
		}
	}).disableSelection();

	// Collect checked items
	function collectCheckedItems(list) {
		"use strict";
		var val = '', caption = '', image = '', icon = '';
		list.find('.themerex_options_menuitem,.themerex_options_listitem').each(function() {
			"use strict";
			if (jQuery(this).hasClass('themerex_options_state_checked')) {
				val += (val ? THEMEREX_OPTIONS_delimiter : '') + jQuery(this).data('value');
				var img = jQuery(this).find('.themerex_options_input_image');
				if (img.length > 0) {
					image = img.eq(0).data('src');
				} else if (jQuery(this).parents('.themerex_options_field_icons').length > 0) {
					icon = jQuery(this).data('value');
				} else {
					caption += (caption ? THEMEREX_OPTIONS_delimiter : '') + jQuery(this).html();
				}
			}
		});
		list.parent().find('input[type="hidden"]').eq(0).val(val).trigger('change');
		if (caption != '')
			list.parent().find('input[type="text"]').eq(0).val(caption);
		if (image != '')
			list.parent().find('.themerex_options_caption_image span').eq(0).css('backgroundImage', 'url('+image+')'); //.attr('src', image);
		if (icon != '') {
			var field = list.parent().find('.themerex_options_input_socials');
			if (field.length > 0) {
				var btn = field.next();
				var cls = btn.attr('class');
				cls = cls.substr(0, cls.indexOf(' iconadmin-')) + ' ' + icon;
				btn.removeClass().addClass(cls).trigger('change');
			} else
				list.parent().find('.themerex_options_caption_icon span').eq(0).removeClass().addClass(icon).trigger('change');
		}
	}



	// Color selector
	//----------------------------------------------------------------
	to_body.find('.themerex_options_input_color').each(function () {
		"use strict";
		jQuery(this).wpColorPicker({
			// you can declare a default color here,
			// or in the data-default-color attribute on the input
			//defaultColor: false,

			// a callback to fire whenever the color changes to a valid color
			change: function(e, ui){
				jQuery(e.target).val(ui.color).trigger('change');
			},

			// a callback to fire when the input is emptied or an invalid color
			clear: function(e) {
				jQuery(e.target).prev().trigger('change')
			},

			// hide the color picker controls on load
			//hide: true,

			// show a group of common colors beneath the square
			// or, supply an array of colors to customize further
			//palettes: true
		});
		//jQuery('.wp-picker-clear').css('width', '80px');
	});



	// Clone buttons
	//----------------------------------------------------------------
	to_body.on('click', '.themerex_options_clone_button_add', function (e) {
		"use strict";
		var clone_area = jQuery(this).parents('.themerex_options_cloneable_area').eq(0);
		var clone_item = null;
		var max_num = 0;
		clone_area.find('.themerex_options_cloneable_item').each(function() {
			"use strict";
			var cur_item = jQuery(this);
			if (clone_item == null) 
				clone_item = cur_item;
			var num = Number(cur_item.find('input[name*="_numbers[]"]').eq(0).val());
			if (num > max_num)
				max_num = num;
		});
		var clonedObj = clone_item.clone();
		clonedObj.find('input[type="text"],textarea').val('');
		clonedObj.find('input[name*="_numbers[]"]').val(max_num+1);
		jQuery(this).before(clonedObj);
		e.preventDefault();
		return false;
	});

	to_body.on('click', '.themerex_options_clone_button_del', function (e) {
		"use strict";
		if (jQuery(this).parents('.themerex_options_cloneable_item').parent().find('.themerex_options_cloneable_item').length > 1)
			jQuery(this).parents('.themerex_options_cloneable_item').eq(0).remove();
		else
			themerex_message_warning(THEMEREX_OPTIONS_STRINGS_del_item_error, THEMEREX_OPTIONS_STRINGS_del_item);
		e.preventDefault();
		return false;
	});



	// Inherit buttons
	//----------------------------------------------------------------
	to_body.on('click', '.themerex_options_button_inherit', function (e) {
		"use strict";
		var inherit = !jQuery(this).hasClass('themerex_options_inherit_off');
		if (inherit) {
			jQuery(this).addClass('themerex_options_inherit_off');
			jQuery(this).parents('.themerex_options_field').find('.themerex_options_content_inherit').fadeOut().find('input').val('');
		} else {
			jQuery(this).removeClass('themerex_options_inherit_off');
			jQuery(this).parents('.themerex_options_field').find('.themerex_options_content_inherit').fadeIn().find('input').val('inherit');
		}
		e.preventDefault();
		return false;
	});
	to_body.on('click', '.themerex_options_content_inherit', function (e) {
		"use strict";
		jQuery(this).parents('.themerex_options_field').find('.themerex_options_button_inherit').addClass('themerex_options_inherit_off');
		jQuery(this).fadeOut().find('input').val('');
		e.preventDefault();
		return false;
	});
}


// Standard actions
//-----------------------------------------------------------------

// Open Wordpress media manager window
var themerex_options_media_frame = [];
function themerex_options_action_media_upload(obj) {
	"use strict";
	var button = jQuery(obj);
	var field  = button.data('linked-field') ? jQuery("#"+button.data('linked-field')).eq(0) : button.siblings('input');
	var fieldId = field.attr('id');
	if ( themerex_options_media_frame[fieldId] ) {
		themerex_options_media_frame[fieldId]['frame'].open();
		return;
	}
	themerex_options_media_frame[fieldId] = [];
	themerex_options_media_frame[fieldId]['field'] = field;
	themerex_options_media_frame[fieldId]['multi'] = button.data('multiple') ? true : false;
	themerex_options_media_frame[fieldId]['frame'] = wp.media({		// = wp.media.frames.media_frame
		// Multiple choise
		multiple:	themerex_options_media_frame[fieldId]['multi'] ? 'add' : false,
		// Set the title of the modal.
		title: button.data('caption-choose'),
		// Tell the modal to show only images.
		library: {
			type: button.data('type') ? button.data('type') : 'image'
		},
		// Customize the submit button.
		button: {
			// Set the text of the button.
			text: button.data('caption-update'),
			// Tell the button to close the modal
			close: true
		}
	});
	themerex_options_media_frame[fieldId]['frame'].on( 'select', function(e) {
		"use strict";
		var attachment = '', pos = -1, init = false;
		if (themerex_options_media_frame[fieldId]['multi']) {
			themerex_options_media_frame[fieldId]['frame'].state().get('selection').map( function( att ) {
				"use strict";
				attachment += (attachment ? "\n" : "") + att.toJSON().url;
			});
			var val = themerex_options_media_frame[fieldId]['field'].val();
			attachment = val + (val ? "\n" : '') + attachment;
		} else {
			attachment = themerex_options_media_frame[fieldId]['frame'].state().get('selection').first().toJSON().url;
			if (!button.data('linked-field')) {
				var output = '';
				if ((pos = attachment.lastIndexOf('.'))>=0) {
					var ext = attachment.substr(pos+1);
					output = '<a class="themerex_options_image_preview" rel="prettyPhoto" target="_blank" href="' + attachment + '">';
					if ('jpg,png,gif'.indexOf(ext)>=0) {
						output += '<img src="'+attachment+'" alt="" rel="prettyPhoto" />';
						init = true;
					} else {
						output += '<span>'+attachment.substr(attachment.lastIndexOf('/')+1)+'</span>';
					}
					output += '</a>';
				}
				button.siblings('.themerex_options_image_preview').remove();
				if (output != '') {
					button.parent().append(output);
					if (init) prettyPhotoInit(THEMEREX_OPTIONS_BODY);
				}
			}
		}
		themerex_options_media_frame[fieldId]['field'].val(attachment).trigger('change');
	});
	themerex_options_media_frame[fieldId]['frame'].open();
}

// Clear media field
function themerex_options_action_media_reset(obj) {
	"use strict";
	var button = jQuery(obj);
	var field  = button.data('linked-field') ? jQuery("#"+button.data('linked-field')).eq(0) : button.siblings('input');
	button.siblings('.themerex_options_image_preview').remove();
	field.val('').trigger('change');
}

// Select fontello icon
function themerex_options_action_select_icon(obj) {
	"use strict";
	var button = jQuery(obj);
	var field  = button.data('linked-field') ? jQuery("#"+button.data('linked-field')).eq(0) : button.siblings('input[type="hidden"]').eq(0);
	button.siblings('.themerex_options_input_menu').slideToggle();
}


// Pretty photo init
function prettyPhotoInit(to_body) {
	//jQuery("a[href$='jpg'],a[href$='jpeg'],a[href$='png'],a[href$='gif']").attr('rel', 'prettyPhoto');
	to_body.find("a[rel*='prettyPhoto']:not(.inited)").each(function() {
		jQuery(this).addClass('inited').prettyPhoto({
			social_tools: '',
			theme: 'facebook',
			deeplinking: false
		});
	});
}


// Init previously hidden elements
//-----------------------------------------------------------------------------------
function themerex_options_init_hidden_elements(container) {
	// Range sliders
	container.find('.themerex_options_field_range:not(.inited)').each(function () {
		"use strict";
		var obj = jQuery(this);
		var scale = obj.find('.themerex_options_range_scale');
		if (scale.width() <= 0) return;
		var step = parseInt(obj.find('.themerex_options_input_range').data('step'));
		var field = obj.find('.themerex_options_input_range input[type="hidden"]').eq(0);
		var val = field.val().split(THEMEREX_OPTIONS_delimiter);
		var rangeMin = parseInt(obj.find('.themerex_options_range_min').html());
		var rangeMax = parseInt(obj.find('.themerex_options_range_max').html());
		var scaleWidth = scale.width();
		var scaleStep = scaleWidth / (rangeMax - rangeMin) * step;
		var i = 0;
		obj.addClass('inited')
			.find('.themerex_options_range_slider').each(function () {
				"use strict";
				var fill = val.length==1 || i==1 ? 'width' : 'left';
				jQuery(this).css('left', (val[i]-rangeMin)*scaleStep+'px');
				scale.find('span').css(fill, ((val[i]-rangeMin)*scaleStep-(i==1 ? (val[0]-rangeMin)*scaleStep : 0))+'px');
				i++;
			}).draggable({
				axis: 'x',
				grid: [scaleStep, scaleStep],
				containment: '.themerex_options_input_range',
				scroll: false,
				drag: function (e, ui) {
					var slider = ui.helper;
					var idx = slider.index()-1;
					var newVal = Math.round(ui.position.left / scaleStep) + rangeMin;
					if (val.length==2) {
						if (idx==0 && newVal > val[1]) {
							newVal = val[1];
							ui.position.left =(newVal-rangeMin)*scaleStep;
						}
						if (idx==1 && newVal < val[0]) {
							newVal = val[0];
							ui.position.left = (newVal-rangeMin)*scaleStep;
						}
					}
					slider.find('.themerex_options_range_slider_value').html(newVal);
					val[idx] = newVal;
					field.val(val.join(THEMEREX_OPTIONS_delimiter)).trigger('change');
					if (val.length==2)
						scale.find('span').css('left', (val[0]-rangeMin)*scaleStep+'px');
					scale.find('span').css('width', ((val[val.length==2 ? 1 : 0]-rangeMin)*scaleStep-(val.length==2 ? (val[0]-rangeMin)*scaleStep : 0))+'px');
				}
			});
	});
}
