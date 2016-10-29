function dialogResponsive(container,width_dialog,height_dialog)
{
	var windowWidth=$(window).width();
	if(windowWidth <= width_dialog) {
		width_dialog="90%";
	}
	
	$("#"+container).dialog({
		autoOpen: false,
		width: width_dialog,
		height: height_dialog,
		modal: true,
		buttons: {
			"Close": function() {
				$(this).dialog("close");
			}
		}					
	});	
}	