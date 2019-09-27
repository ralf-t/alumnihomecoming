$(function() {
	$('#info-card').hide();
	$('#loading').hide();

	document.getElementById('ticket').maxLength = '4';

	$('#ticket').keyup(function() {
		$('#loading').show();
		var ticket = $(this).val();
		if (ticket.toString().length == 4){
			$.ajax({
				url: 'ticket/' + ticket,
				success: function(response) {
					$('#loading').hide();
					$('#info-card').show();
					$('#lastname').val(response.last_name);
					$('#firstname').val(response.first_name);
					$('#middlename').val(response.middle_name);
				},
				error: function(response) {
					alert('Ticket Number not found.');
					$('#loading').hide();
				}
			});
		} else {
			$('#info-card').hide();
			$('#loading').hide();
		}
	});

	$('#birthdate').datepicker({
		format: "MM d, yyyy",
		autoclose: true,
	});
});