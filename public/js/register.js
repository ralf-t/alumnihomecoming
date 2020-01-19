var error = [false, false];

function Confirm() {
	var firstname = $('#first_name').val().toUpperCase();
	var lastname = $('#last_name').val().toUpperCase();
	var middlename = $('#middle_name').val().toUpperCase();
	var ticket = $('#ticket').val();
	var batch = $('#batch').val();
	var fullname = firstname + ' ' + middlename + ' ' + lastname;
	var confirmation = confirm("Please confirm:\n\n" + fullname + "\nyour ticket number is/are \n\n" + ticket);
	if (confirmation == true) {
		$('button#submit').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '',
			data: {"last_name":lastname, "first_name":firstname, "middle_name":middlename, "ticket_no":ticket, "batch_year":batch},
			datatype: 'JSON',
			success: function(response) {
				if (response.status == 'success') {
					Swal.fire({
						type: 'success',
						title: 'Successfully registered.',
						timer: 2000,
						showConfirmButton: false,
					}).then(function() {
						location.reload();
					});
				} else {
					Swal.fire({
						type: 'error',
						title: 'Something went wrong in the server. Please try registering again.',
						confirmButtonText: 'Refresh',
					}).then(function() {
						location.reload();
					});
				}
			},
			error: function() {
				Swal.fire({
					type: 'warning',
					title: 'Something went wrong. Please try registering again.',
					confirmButtonText: 'Refresh',
				}).then(function() {
					location.reload();
				});
			}
		});
	}
}

function checkTicket(ticket) {
	$.ajax({
		url: 'validation/' + ticket,
		success: function(response) {
			if (response == '1') {
				Swal.fire({
					type: 'error',
					text: 'Ticket number already register',
					timer: 1500,
					showConfirmButton: false,
				}).then(function() {
					$('button#submit').attr('disabled', 'disabled');
					$('#ticket').addClass('is-invalid');
					error[1] = true;
				});
			} else {
				$('#ticket').removeClass('is-invalid');
				$('button#submit').removeAttr('disabled');
				error[1] = false;
			}
		}, error: function() {
			Swal.fire({
				type: 'warning',
				text: 'Something went wrong on the server. Please refresh and try again.',
				confirmButtonText: 'Refresh',
			}).then(function() {
				location.reload();
			});
		}
	});
}

function disableSubmit(errors) {
	if (errors[0] == false && errors[1] == false)
		$('button#submit').removeAttr('disabled');
	else
		$('button#submit').attr('disabled', 'disabled');
}

$(function() {
	document.getElementById('batch').maxLength = '4';
	document.getElementById('ticket').maxLength = '4';

	Swal.fire({
		title: 'Privacy Notice',
		text: 'The event organizers collected information from you as participants for the purposes of registration and overall event management. By providing your information, you are giving your consent to us to use your information for the aforementioned purposes. After conclusion of the event and completion of all necessary reports, your personal data will be saved in secured files for future references and networking activities. IF YOU DO NOT WISH TO BE CONTACTED FURTHER AFTER THIS EVENT, KINDLY INFORM THE ORGANIZERS.',
		type: 'info',
		confirmButtonText: 'Proceed',
	});

	$(document).on('keypress', function(e) {
		if(e.which == 13)
			$('button.swal2-confirm').click();
	});

	$('#batch').keyup(function() {
		var batch = $(this).val();
		if (batch.length >= 0 && batch.length < 4) {
			$(this).removeClass('is-invalid');
			error[0] = true;
		} else {
			$(this).removeClass('is-invalid');
			if (isNaN(batch)) {
				$(this).addClass('is-invalid');
				error[0] = true;
			} else if (batch.indexOf(" ") >= 0) {
				$(this).addClass('is-invalid');
				error[0] = true;
			} else {
				error[0] = false;
			}
			console.log(error);
		}
		disableSubmit(error);
	});

	$('#ticket').keyup(function() {
		var ticket = $(this).val();
		if (ticket.length >= 0 && ticket.length < 4) {
			$(this).removeClass('is-invalid');
			error[1] = true
		} else {
			$('button#submit').attr('disabled', 'disabled');
			checkTicket(ticket);
		}

		if (isNaN(ticket)) {
			$(this).addClass('is-invalid');
			error[1] = true;
		} else if (ticket.indexOf(" ") >= 0) {
			$(this).addClass('is-invalid');
			error[1] = true;
		}
		disableSubmit(error);
	});

	$('form').submit(function(e) {
		e.preventDefault();
		Confirm();
	});
});