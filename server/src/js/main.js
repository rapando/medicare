jQuery(document).ready(function($) {
	$('.progress1').hide();
	$('.progress2').hide();
	
	
	$('a[href="#"]').on('click', function(e) {
		e.preventDefault();
	});

	$('.slider').slider({full_width : true, indicators : false, height : 450, interval : 4000, transition : 1000});
	setTimeout(function() {
		Materialize.showStaggeredList('#loginForm');
		$('.loginBtn').addClass('disabled');
	}, 500);

	$('#pass').on('keyup', function() {
		$('.loginBtn').removeClass('disabled');
	})

	$('.loginBtn').on('click', function(e) {
		$('.progress1').show();
		$('.loginBtn').addClass('disabled');
		e.preventDefault();
	});

	$('a[href="#forgot"]').on('click', function() {
		Materialize.showStaggeredList("#resetForm");
		$('.resBtn').addClass('disabled');
	});

	$('#email').on('keyup', function() {
		$(".resBtn").removeClass('disabled');
	});

	$('.resBtn').on('click', function(e) {
		$('.progress2').show();
		$('.resBtn').addClass('disabled');
		e.preventDefault();
	})
});

