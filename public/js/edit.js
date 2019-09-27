function Success() {
	Swal.fire({
		type: 'success',
		title: 'Guest Information Updated',
		timer: 1500,
		showConfirmButton: false,
	});
}

$(function() {
	$('#loading').hide();

	$('#birthdate').datepicker({
		format: "MM d, yyyy",
		autoclose: true,
	});

	document.getElementById('ticket').maxLength = '4';
});