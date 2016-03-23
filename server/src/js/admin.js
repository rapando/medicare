jQuery(document).ready(function($) {
	$('select').material_select();
	$('.progress1').hide();
	$('a[href="#add-hospital"]').on('click', function(e) {
		e.preventDefault();
		Materialize.showStaggeredList('#add-hospital-form');
	});

	// add a hospital
	$("#addHospitalBtn").on('click', function(e) {
		$('.progress1').show();
		$("#addHospitalBtn").addClass('disabled');
		e.preventDefault();

		var hospitalName = $("#hospitalName").val();
		var hospitalLocation = $("#hospitalLocation").val();
		var county = $("#county").val();

		var data = JSON.stringify({hospitalName : hospitalName, hospitalLocation : hospitalLocation, county : county, req : 'addHospital'});
		$.ajax({
			dataType : 'json',
			data  : data,
			type : 'post',
			timeout : 10000,
			url : '../src/php/adminRequests.php',
			success : function(res) {
				if(res == 0) Materialize.toast("Error adding the Hospital", 2000);
				else Materialize.toast("Hospital Added successfully", 2000);
				$("#hospitalName").val('');
				$("#hospitalLocation").val('');

				$("#addHospitalBtn").removeClass('disabled');
				$('.progress1').hide();
			},
			error : function() {
				Materialize.toast('Network error', 2000);
				$("#addHospitalBtn").removeClass('disabled');
				$('.progress1').hide();
			}
		});

	})
});
