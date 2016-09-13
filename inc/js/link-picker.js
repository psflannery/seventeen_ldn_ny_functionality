jQuery(document).ready(function($) {

	// Set Defaults
	var url = $('body');
	var text = $('body');
	var blank = $('body');

	// Open the Link Window
	$('body').on('click', '.js-insert-link', function(event) {
		// Stop the defalut event from happening
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		event.stopPropagation();

		// Set the variables to related to the chosen control
		url = $(this).closest('.seventeen-ldn-ny-link-picker').find('input.cmb_text_url');
		text = $(this).closest('.seventeen-ldn-ny-link-picker').find('input.cmb_text');
		//blank = $(this).closest('.seventeen-ldn-ny-link-picker').find('input.cmb_checkbox');
		blank = $(this).closest('.seventeen-ldn-ny-link-picker').find('select.cmb_checkbox');
		
		// Open the link picker
		wpActiveEditor = true;
		wpLink.open();
		wpLink.textarea = url;

		return false;
	});

	// If the action is canceled, close the link picker pop-up
	$('body').on('click', '#wp-link-cancel, #wp-link-backdrop, #wp-link-close', function(event) {
		wpLink.textarea = url;
		wpLink.close();
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		event.stopPropagation();

		return false;
	});

	// Once the link is chosen, populate the control
	$('body').on('click', '#wp-link-submit', function(event) {
		console.log(text)
		var linkAtts = wpLink.getAttrs();

		linkAtts.text = $('#wp-link-text').val();

		url.val(linkAtts.href);

		if( linkAtts.text != '' ) {
			text.val(linkAtts.text);
		}

		if (linkAtts.target == '_blank') {
			//blank.prop('checked', true);
			blank.val('true');
		} else {
			//blank.prop('checked', false);
			blank.val('false');
		}

		wpLink.textarea = url;
		wpLink.close();
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		event.stopPropagation();
		
		return false;
	});

	// Deal with columns and sizes
    function adjust_element_size() {
		$('.seventeen-ldn-ny-link-picker div').attr('style','');
		$('.cmb-type-link-picker').each( function() {
			url       = $(this).find('input.cmb_text_url');
			container = $(this).find('.seventeen-ldn-ny-link-picker');
			if( url.width() < 150 ) {
				container.find('div').each( function() {
					$(this).css('width', '50%');
				});
			}
		});
    }

    // Execute on load
    adjust_element_size();

    // Bind event listener
    $(window).resize( adjust_element_size );

});
