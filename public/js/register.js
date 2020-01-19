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
			dataType: 'JSON',
			succes: function(response) {
				if (response.success) {
					Swal.fire({
						type: 'success',
						title: 'Successfully registered.',
						showConfirmButton: false,
					});
				} else {
					Swal.fire({
						type: 'error',
						title: 'Something went wrong in the server. Please try registering again.',
						showConfirmButton: 'Refresh',
					});
				}
			},
			error: function() {
				Swal.fire({
					type: 'warning',
					title: 'Something went wrong. Please try registering again.',
					confirmButtonText: 'Refresh',
				});
			}
		}).done(function() {
			location.reload();
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
					text: 'Ticket number already registered',
					timer: 1500,
					showConfirmButton: false,
				});
				$('button#submit').attr('disabled', 'disabled');
				$('#ticket').addClass('is-invalid');
			} else {
				$('#ticket').removeClass('is-invalid');
				$('button#submit').removeAttr('disabled');
			}
		},
		error: function(response) {
			Swal.fire({
				type: 'warning',
				text: 'Something went wrong in the server. Please refresh and try again.',
				confirmButtonText: 'Refresh',
			}).done(function() {
				location.reload();
			});
		},
	});
}

function disableSubmit(t, b) {
	if (t == true || b == true)
		$('button#submit').attr('disabled', 'disabled');
	else
		$('button#submit').removeAttr('disabled');
}

$(function() {
	document.getElementById('batch').maxLength = '4';
	document.getElementById('ticket').maxLength = '4';
	var tickets;
	var error_b = false;
	var error_t = false;

	Swal.fire({
		title: 'Privacy Notice',
		text: 'The event organizers collected information from you as participants for the purposes of registration and overall event management. By providing your information, you are giving your consent to us to use your information for the aforementioned purposes. After conclusion of the event and completion of all necessary reports, your personal data will be saved in secured files for future references and networking activities. IF YOU DO NOT WISH TO BE CONTACTED FURTHER AFTER THIS EVENT, KINDLY INFORM THE ORGANIZERS.',
		type: 'info',
		confirmButtonText: 'Proceed',
	});

	$(document).on('keypress', function(e) {
		if(e.which == 13) {
			$('button.swal2-confirm').click();
		}
	});

	$('#batch').keyup(function() {
		var batch = $(this).val();
		if (isNaN(batch)) {
			$(this).addClass('is-invalid');
			error_b = true;
		} else if (batch.indexOf(" ") >= 0) {
			$(this).addClass('is-invalid');
			error_b = true;
		} else {
			$(this).removeClass('is-invalid');
			error_b = false;
		}

		if (batch.length > 0 && batch.length < 4)
			error_b = true;
		else
			error_b = false;

		disableSubmit(error_t, error_b);
	});

	$('#ticket').keyup(function() {
		var ticket = $(this).val();
		if (isNaN(ticket)) {
			$(this).addClass('is-invalid');
			error_t = true;
		} else if (ticket.indexOf(" ") >= 0) {
			$(this).addClass('is-invalid');
			error_t = true;
		} else {
			$(this).removeClass('is-invalid');
			error_t = false;
		}

		if (ticket.length > 0 && ticket.length < 4)
			error_t = true
		else
			error_b = false

		disableSubmit(error_t, error_b)

		if (ticket.length == 4) {
			$('button#submit').attr('disabled', 'disabled');
			checkTicket(ticket);
		}
	});

	$('form').submit(function(e) {
		e.preventDefault();
		Confirm();
	});
});