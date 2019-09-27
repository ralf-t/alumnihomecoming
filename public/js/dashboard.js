function Success() {
	Swal.fire({
		type: 'success',
		title: 'Guest Removed',
		showConfirmButton: false,
		timer: 5000,
		allowOutsideClick: false,
		allowEscapeKey: false,
		allowEnterKey: false,
	});
}

$(function() {
	let id = null;

	$('#wrapper-content').hide();
	$('.modal-header').hide();
	$('#view-wrapper-content').hide();
	$('#view-wrapper-load').hide();

	$('button#link-delete').click(function(e) {
		id = $(this).data('id');

		$.ajax({
			url: 'guests/' + id,
			success: function(response) {
				$('#wrapper-load').hide();

				$('#placeholder-delete').html(response.first_name + ' ' + response.last_name);

				$('#wrapper-content').fadeIn();
			},
			error: function(response) {
				Swal.fire({
					type: 'error',
					title: 'Something went wrong. Please try again later.',
					timer: 2000,
					showConfirmButton: false,
				});

				$('#modal-delete').removeClass('show');
				$('div.modal-backdrop').removeClass('show');
			}
		});

		$('#wrapper-content').hide();
		$('#wrapper-load').show();
	});

	$('#delete').click(function(e) {
		window.location = 'guests/' + id + '/delete';
		$.then(Success());
	});

	$('button#link-view').click(function(e) {
		id = $(this).data('id');

		$.ajax({
			url: 'guests/' + id,
			success: function(response) {
				if (response.middle_name != null)
					$('#placeholder-fullname').html(response.first_name + ' ' + response.middle_name + ' ' + response.last_name);
				else {
					$('#placeholder-fullname').html(response.first_name + ' ' + response.last_name);
				}
				$('#placeholder-birthdate').html(response.birth_date);
				$('#placeholder-batch').html(response.batch_year);
				$('#placeholder-degree').html(response.degree);
				$('#placeholder-honors').html(response.honors);
				$('#placeholder-profession').html(response.profession);
				$('#placeholder-company').html(response.company_org);
				$('#placeholder-address').html(response.address);
				$('#placeholder-residence').html(response.residence);
				$('#placeholder-telephone').html(response.telephone);
				$('#placeholder-cellphone').html(response.cellphone);
				$('#placeholder-email').html(response.email);
				$('#view-wrapper-load').hide();
				$('.modal-header').show();
				$('#view-wrapper-content').fadeIn();
			},
			error: function(response) {
				Swal.fire({
					type: 'error',
					title: 'Something went wrong. Please try again later.',
					timer: 2000,
					showConfirmButton: false,
				});

				$('#modal-view').removeClass('show');
				$('div.modal-backdrop').removeClass('show');
			}
		});

		$('#view-wrapper-load').show();
		$('.modal-header').hide();
		$('#view-wrapper-content').hide();
	});
});