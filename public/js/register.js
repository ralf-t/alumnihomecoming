$('form').bind('ajax:complete', function CheckDuplicates() {
	if (duplicate == true) {
		Swal.fire({
			type: 'error',
			text: 'Ticket number already registered',
			timer: 1500,
		});
		break;
	} else if (valid_err == true) {
		Swal.fire({
			type: 'error',
			text: 'Something went wrong, please try again later.',
			confirmButtonText: 'Okay',
		});
		break;
	}
});

function Confirm() {
	var firstname = document.getElementById('first_name').value;
	var lastname = document.getElementById('last_name').value;
	var middlename = document.getElementById('middle_name').value;
	var ticket = document.getElementById('ticket').value;
	var fullname = firstname + ' ' + middlename + ' ' + lastname;
	return confirm("Please Confirm\n\n" + fullname + "\nyour ticket number is/are \n\n" + ticket);
}

var duplicate = false;
var valid_err = false;

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

	$.ajax({
		url: 'validation',
		success: function(response) {
			tickets = response;
		},
		error: function(response) {
			valid_err = true;
		},
	});


	$(document).on('keypress', function() {
		if(e.which == 13) {
			$('button.swal2-confirm').click();
		}
	});

	var error_b = false;
	var error_t = false;

	$('#batch').keypress(function() {
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

		alert(tickets.Length());
		for (var i = 0; i < tickets.Length(); i ++) {
			if (tickets[i] == parseInt(ticket)) {
				duplicate = true;
				alert('duplicate');
			} else {
				duplicate = false;
			}
		}
	});
});

