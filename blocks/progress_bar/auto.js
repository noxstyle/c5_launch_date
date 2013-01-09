$(document).ready(function(){
	$('#progress-setup .date').datepicker({'dateFormat': 'yy-mm-dd'});

	$("#progress-setup select[name='type']").on('change',function(){
		var selected = $("#progress-setup select[name='type'] option[value='"+$(this).val()+"']").text();
		$("#progress-setup div[id^='settings-']").hide();
		$('#progress-setup #settings-'+$.trim(selected.toLowerCase())).show();
	});
});