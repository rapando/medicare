jQuery(document).ready(function($) {
	$('select').material_select();
	$('.progress1, .progress2, .progress3').hide();
	$("a[href='#top']").on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop : $(".main-body").offset().top
		}, 1000);
	});


	$('a[href="#add-hospital"]').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({
			 scrollTop: $("#add-hospital").offset().top
	 }, 500);
		Materialize.showStaggeredList('#add-hospital-form');
	});

	$('a[href="#add-pharmacy"]').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({
			 scrollTop: $("#add-pharmacy").offset().top
	 }, 500);
		Materialize.showStaggeredList('#add-pharmacy-form');
	})

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

	});

	// add pharmacy

	$("#addPharmacyBtn").on('click', function(e) {
		$('.progress2').show();
		$("#addPharmacyBtn").addClass('disabled');
		e.preventDefault();

		var pharmacyName = $("#pharmacyName").val();
		var pharmacyLocation = $("#pharmacyLocation").val();
		var pharmacyCounty = $("#pharmacyCounty").val();
		var pharmacyPhone = $("#pharmacyPhone").val();
		var data = JSON.stringify({req : 'addPharmacy', name : pharmacyName, phone : pharmacyPhone, location : pharmacyLocation, county : pharmacyCounty});


		$.ajax({
			dataType : 'json',
			data  : data,
			type : 'post',
			timeout : 10000,
			url : '../src/php/adminRequests.php',
			success : function(res) {
				if(res == 0) Materialize.toast("Error adding the Pharmacy", 2000);
				else Materialize.toast("Pharmacy Added successfully", 2000);
				$("#pharmacyLocation").val('');
				$("#pharmacyName").val('');
				$("#pharmacyPhone").val('');
				$("#addPharmacyBtn").removeClass('disabled');
				$('.progress2').hide();
			},
			error : function() {
				Materialize.toast('Network error', 2000);
				$("#addPharmacyBtn").removeClass('disabled');
				$('.progress2').hide();
			}
		});
	});

	$("a[href='#viewDocs']").click(function(e) {
		e.preventDefault();
		$('html, body').animate({
			 scrollTop: $("#viewDocs").offset().top
	 	}, 500);
		Materialize.showStaggeredList('#doc-list');
	});

});
