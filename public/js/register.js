function Confirm() {
	var firstname = document.getElementById('first_name').value;
	var lastname = document.getElementById('last_name').value;
	var middlename = document.getElementById('middle_name').value;
	var ticket = document.getElementById('ticket').value;
	firstname = firstname.toUpperCase();
	lastname = lastname.toUpperCase();
	middlename = middlename.toUpperCase();
	var fullname = firstname + ' ' + middlename + ' ' + lastname;
	var confirmation = confirm("Please confirm:\n\n" + fullname + "\nyour ticket number is/are \n\n" + ticket)/*.then(Success(response))*/;
	if (confirmation == true) {
		Success();
	}
	return confirmation;
}

function Success() {
	Swal.fire({
		type: 'success',
		title: 'Successfully registered.',
		showConfirmButton: false,
	});
	return confirmation;
}

$(function() {
	document.getElementById('batch').maxLength = '4';
	document.getElementById('ticket').maxLength = '4';
	var tickets;

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

	var error_b = false;
	var error_t = false;

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

		if (error_b == true || error_t == true) {
			$('button#submit').attr('disabled', 'disabled');
		} else {
			$('button#submit').removeAttr('disabled');
		}
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

		if (error_t == true || error_b == true) {
			$('button#submit').attr('disabled', 'disabled');
		} else {
			$('button#submit').removeAttr('disabled');
		}

		if (ticket.length == 4) {
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
				},
			});
		}
	});
});

