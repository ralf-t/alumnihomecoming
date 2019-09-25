$(function() {
	Swal.fire({
		title: 'Privacy Notice',
		text: 'The event organizers collected information from you as participants for the purposes of registration and overall event management. By providing your information, you are giving your consent to us to use your information for the aforementioned purposes. After conclusion of the event and completion of all necessary reports, your personal data will be saved in secured files for future references and networking activities. IF YOU DO NOT WISH TO BE CONTACTED FURTHER AFTER THIS EVENT, KINDLY INFORM THE ORGANIZERS.',
		type: 'info',
		confirmButtonText: 'Proceed',
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
