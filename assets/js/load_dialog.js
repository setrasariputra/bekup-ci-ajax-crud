$(document).ready(function() {
	$(".load-dialog").live("click", function(e) {
		e.preventDefault();
		
		var config=$(this).attr("id");	
		var explode=config.split("##");
		
		var dialog=explode[0];
		var ajax_address=explode[1];
		var div_ajax=explode[2];

		$("#ajax-loader").show();
		$("input[type='submit']").attr("disabled","disabled");
		$("input[type='button']").attr("disabled","disabled");		
		$("."+div_ajax).html('Loading...');
		
		//alert(ajax_address);
		
		$("#"+dialog).dialog("open");	
		$(".form-submit input").attr("disabled",false);
		$(".form-submit select").attr("disabled",false);
		$(".form-submit input[type='text']").val('');
		$(".form-submit select").val('');
		$(".form-submit textarea").val('');
		
		// open first tabs
		$("#"+dialog).tabs({selected: 0});		
		
		if((ajax_address != 'none') && (div_ajax != 'none')) {
			$("."+div_ajax).load(ajax_address+"/"+Math.random(), function() {
				$("#ajax-loader").hide();
				$("input[type='submit']").attr("disabled",false);
				$("input[type='button']").attr("disabled",false);				
			});
		}else{
			$("#ajax-loader").hide();
			$("input[type='submit']").attr("disabled",false);
			$("input[type='button']").attr("disabled",false);							
		}
		
		return false;		
	});
});