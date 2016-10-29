$(document).ready(function() {
	$(".paging").live("click", function() {

		var config=$(this).attr("name");
		var explode=config.split("##");

		var type=explode[0];
		var address=explode[1];
		var div_tabledata=explode[2];
		var field=$("#"+explode[3]).val();
		var sort=$("#"+explode[4]).val();
		var numberpaging=$("#"+explode[5]).val();
		var display_number_paging=explode[6];
		var maxpaging=$("."+explode[7]).val();

		$("#ajax-loader").show();
		$("input[type='submit']").attr("disabled","disabled");
		$("input[type='button']").attr("disabled","disabled");		
		
		if(maxpaging > 0) {
			if(type == 'next') {
				numberpaging++;
				if(numberpaging == maxpaging) {
					numberpaging=numberpaging - 1;
				}			
				$("#"+explode[5]).val(numberpaging);
				$("."+display_number_paging).html(numberpaging + 1);
			}else
			if(type == 'prev') {
				numberpaging--;
				if(numberpaging < 0) {
					numberpaging=0;
				}						
				$("#"+explode[5]).val(numberpaging);
				$("."+display_number_paging).html(numberpaging + 1);
			}
		}
		
		if(field == '') {
			field=0;
		}
		if(sort == '') {
			sort=0;
		}

		var get_id=$(this).attr("lang");
		if(get_id != 'none') {
			var val_get_id=$("#"+get_id).val();

			var new_address=address+"/"+field+"/"+sort+"/"+numberpaging+"/"+val_get_id+"/"+Math.random();
		}else{
			var new_address=address+"/"+field+"/"+sort+"/"+numberpaging+"/"+Math.random();
		}	
		
		//alert(new_address);	
		
		$("#"+div_tabledata).fadeTo('medium', 0.5, function() {
			$("#"+div_tabledata).load(new_address, function() {
				$("#"+div_tabledata).fadeTo('medium', 1.0);			
				$("#ajax-loader").hide();
				$("input[type='submit']").attr("disabled",false);
				$("input[type='button']").attr("disabled",false);								
			});
		});
		
	});
});