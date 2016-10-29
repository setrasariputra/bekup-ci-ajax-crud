$(document).ready(function() {
	$(".delete").live("click", function() {
		var config=$(this).attr("id");
		var explode=config.split("##");
		
		var address_process=explode[0]+'/'+Math.random();
		var address_tabledata=explode[1];
		var tabledata=explode[2];
		var field=$("#"+explode[3]).val();
		var sort=$("#"+explode[4]).val();
		var numberpaging=$("#"+explode[5]).val();
		var maxpaging=explode[6];
		var display_maxpaging=explode[7];
		
		var get_id=$(this).attr("name");
		
		//alert(address_process);
		
		var answer=confirm("Are you sure want to delete this data...?\nIf yes, all data that include in this ID will be remove too..");
		if(answer) {
			$("#ajax-loader").show();
			$("input[type='submit']").attr("disabled","disabled");
			$("input[type='button']").attr("disabled","disabled");					
			$.getJSON(address_process, function(out) {
				var output=out.output;				
				if(output == 'true') {
					// Load Tabledata
					if(field == '') {
						field='0';
					}
					if(sort == '') {
						sort='0';
					}

					if(get_id != 'none') {
						var val_get_id=$("#"+get_id).val();
			
						var new_address=address_tabledata+"/"+field+"/"+sort+"/"+numberpaging+"/"+val_get_id+"/"+Math.random();
					}else{
						var new_address=address_tabledata+"/"+field+"/"+sort+"/"+numberpaging+"/"+Math.random();
					}						
					
					//alert(new_address);
									
					$("#"+tabledata).load(new_address, function() {
						$("#"+tabledata).hide();		
						$("#"+tabledata).fadeIn('medium');
						
						maxpaging=$("#"+maxpaging).val();
						$("#"+display_maxpaging).html(maxpaging);
						
						$("#ajax-loader").hide();
						$("input[type='submit']").attr("disabled",false);
						$("input[type='button']").attr("disabled",false);										
					});
				}else{
					alert(output);
					$("#ajax-loader").hide();
					$("input[type='submit']").attr("disabled",false);
					$("input[type='button']").attr("disabled",false);						
				}
			});
		}		
		
		return false;
		
	});
});