function Confirm() {
	var firstname = document.getElementById('first_name').value;
	var lastname = document.getElementById('last_name').value;
	var middlename = document.getElementById('middle_name').value;
	var ticket = document.getElementById('ticket').value;
	var fullname = firstname + ' ' + middlename + ' ' + lastname;

	$.ajax({
		url: 'validation',
		success: function(response) {
			// for (var i = 0; i < count(response); i ++) {
			// 	if (ticket == response.ticket_no) {
			// 		Swal.fire({
			// 			type: 'error',
			// 			text: 'Ticket number already registered',
			// 			timer: 1500,
			// 		});
			// 	} else {
			// 		Swal.fire({
			// 			type: 'success',
			// 			text: 'Successfully registered',
			// 			timer: 1500,
			// 		});
			// 	}
			// }
			alert(response[1]);
		},
		error: function(response) {
			Swal.fire({
				type: 'error',
				text: 'Something went wrong, please try again later.',
				confirmButtonText: 'Okay',
			});
		},
	});

	return confirm("Please Confirm\n\n" + fullname + "\nyour ticket number is/are \n\n" + ticket);
}

$(function() {
	Swal.fire({
		title: 'Privacy Notice',
		text: 'The event organizers collected information from you as participants for the purposes of registration and overall event management. By providing your information, you are giving your consent to us to use your information for the aforementioned purposes. After conclusion of the event and completion of all necessary reports, your personal data will be saved in secured files for future references and networking activities. IF YOU DO NOT WISH TO BE CONTACTED FURTHER AFTER THIS EVENT, KINDLY INFORM THE ORGANIZERS.',
		type: 'info',
		confirmButtonText: 'Proceed',
	});

	$(document).on('keypress', function() {
		if(e.which == 13) {
			$('button.swal2-confirm').click();
		}
	});
});

