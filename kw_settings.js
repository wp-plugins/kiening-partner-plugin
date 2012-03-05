/*############### Error messages ######################*/	
jQuery(function(){
	var error_msg = jQuery("#message p[class='setting-error-message']");
	// look for admin messages with the "setting-error-message" error class
	if (error_msg.length != 0) {
		// get the title
		var error_setting = error_msg.attr('title');
		
		// look for the label with the "for" attribute=setting title and give it an "error" class (style this in the css file!)
		jQuery("label[for='" + error_setting + "']").addClass('error');
		
		// look for the input with id=setting title and add a red border to it.
		jQuery("input[id='" + error_setting + "']").attr('style', 'border-color: red');
	}	
});

/*################## Imageselector #####################*/
function kw_loadbadge(uribase) {
	
	var badges = new Array();
	badges[1]  = "Microbutton_black.gif";
	badges[2]  = "Microbutton_blue.gif";
	badges[3]  = "Microbutton_green.gif";
	badges[4]  = "Microbutton_red.gif";
	badges[5]  = "Microbutton_orange.gif";
	badges[6]  = "Microbutton_yellow.gif";
	badges[7]  = "Microbutton_white.gif";
	badges[8]  = "Microbutton_grey.gif";
	badges[9]  = "Microbutton_brown.gif";
	badges[10] = "Microbutton_water.gif";
	
	fo = document.getElementById("kw_badge_logo");
	cv = fo.options[fo.selectedIndex].value;
	
	im = document.getElementById("kiening_badge_preview");
	im.src = uribase + badges[cv];
}