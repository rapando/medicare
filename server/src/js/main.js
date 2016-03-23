jQuery(document).ready(function($) {
	$('.progress1').hide();
	$('.progress2').hide();

	$('select').material_select();

	$("#aboutDoc").trigger('autoresize');
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

		// login the doc
		var uname = $("#uname").val();
		var pass = $("#pass").val();

		$.ajax({
			dataType : 'json',
			data : {req : 'docLogin', uname : uname, pass : pass},
			type : 'post',
			url : 'src/php/requests.php',
			timeout : 10000,
			success : function(res) {
				if(res == 1) window.location.href="doc";
				else Materialize.toast("Wrong credentials", 4000);

				$('.progress1').hide();
				$('.loginBtn').removeClass('disabled');
			}, error : function() {
				Materialize.toast("network error", 2000);
				$('.progress1').hide();
				$('.loginBtn').removeClass('disabled');
			}
		});
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
	});

	$("a[href='#register']").on('click', function(e) {

		Materialize.showStaggeredList("#registerForm");

	})
});
