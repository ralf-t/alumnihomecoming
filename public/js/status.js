$(function() {
	$('form[name="form_login"]').submit(function(e) {
		e.preventDefault();
		$.ajax({
			method: 'POST',
			url: 'login',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(response) {
				if (response.success == true) {
					Swal.fire({
						type: 'success',
						title: 'Logged in successfully',
						showConfirmButton: false,
						timer: 2000,
					});
					window.location = 'dashboard';
				} else {
					Swal.fire({
						type: 'error',
						title: 'Incorrect username and/or password.',
						showConfirmButton: false,
						timer: 1500,
					});
				}
			},
			error: function(response) {
				Swal.fire({
					type: 'error',
					title: 'Something went wrong. Please try again later.',
					showConfirmButton: false,
					timer: 3000,
				});
			}
		});
	});
});