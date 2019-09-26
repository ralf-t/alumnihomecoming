function Confirm() {
	var firstname = document.getElementById('first_name').value;
	var lastname = document.getElementById('last_name').value;
	var middlename = document.getElementById('middle_name').value;
	var ticket = document.getElementById('ticket').value;
	var fullname = firstname + ' ' + middlename + ' ' + lastname;
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

	var min = 1946,
	max = new Date(),
	select = document.getElementById('batch');

	for (var i = max.getFullYear() - 1; i>=min; i--){
		var opt = document.createElement('option');
		opt.value = i;
		opt.innerHTML = i;
		select.appendChild(opt);
	}
});

