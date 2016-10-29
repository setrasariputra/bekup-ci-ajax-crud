$(document).ready(function() {
	$(".form-submit").live("submit",function() {
		var config=$(this).attr("name");
		var explode=config.split("##");
		var dialog=explode[0];
		var address_tabledata=explode[1];
		var div_tabledata=explode[2];
		var div_number_paging=explode[3];
		var div_display_number_paging=explode[4];
		var field=explode[5];
		var sort=explode[6];
		var numberpaging=explode[7];
		var maxpaging=explode[8];
		var display_maxpaging=explode[9];
		var dataCSRF=$(this).attr("data-csrf");

		// get button label
		var button=$(".form-submit input[type='submit']");
		var buttonLabel=button.val();
		button.val("Process...");

		$("#ajax-loader").show();
		$("input[type='submit']").attr("disabled","disabled");
		$("input[type='button']").attr("disabled","disabled");		
				
		$.ajax({
			type:'POST',
			url:$(this).attr('action')+'/'+Math.random(),
			data:$(this).serialize(),
			dataType:'json',
			cache:false,
			success:function(out) {
				$("input[type='submit']").attr("disabled",false);
				$("input[type='button']").attr("disabled",false);								
								
				// set to default label
				button.val(buttonLabel);

				var output=out.output;
				if(output == 'true') {
					// Load Tabledata
					if((field != 'none') || (sort != 'none') || (numberpaging != 'none')) {
						field=$("#"+field).val();
						sort=$("#"+sort).val();
						if(field == '') {
							field='0';
						}
						if(sort == '') {
							sort='0';
						}
						numberpaging=$("#"+numberpaging).val();
					}else{
						field='0';
						sort='0';
						numberpaging='0';
						// Default Sort and paging
						$("#"+div_number_paging).val(0);
						$("#"+div_display_number_paging).html(1);												
					}
					
					address_tabledata=address_tabledata+"/"+field+"/"+sort+"/"+numberpaging+"/"+Math.random();
					//alert(address_tabledata);					
					
					$("#"+dialog).dialog("close");	
					$("#"+div_tabledata).load(address_tabledata, function() {
						$("#ajax-loader").hide();
						$("#"+div_tabledata).hide();
						$("#"+div_tabledata).fadeIn('medium');	
												
						maxpaging=$("#"+maxpaging).val();
						$("#"+display_maxpaging).html(maxpaging);						
					});
										
				}else{
					$("#ajax-loader").hide();
					alert(output);
				}

				// get csrf
				if(dataCSRF !== undefined) {
					$.getJSON(dataCSRF, function(outCSRF) {
						var hash=outCSRF.hash;
						$(".csrf-token").val(hash);
					});
				}
			},
		    error: function (xhr, ajaxOptions, thrownError) {
				$("#ajax-loader").hide();
				$("input[type='submit']").attr("disabled",false);
				$("input[type='button']").attr("disabled",false);		

				// set to default label
				button.val(buttonLabel);				

		        alert(thrownError);

				// get csrf
				if(dataCSRF !== undefined) {
					$.getJSON(dataCSRF, function(outCSRF) {
						var hash=outCSRF.hash;
						$(".csrf-token").val(hash);
					});
				}		        
		    }			
		});
		
		return false;
	});
});
