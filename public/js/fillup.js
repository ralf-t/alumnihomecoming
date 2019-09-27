function Success() {
	Swal.fire({
		type: 'success',
		title: 'Guest Information Updated',
		text: 'Guest is now part of the raffle.',
		timer: 5000,
		showConfirmButton: false,
	});
}

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
					var id = response.id;
					$('#loading').hide();
					$('#info-card').show();
					$('form').attr('action', 'fillup/' + id);
					$('#lastname').val(response.last_name);
					$('#firstname').val(response.first_name);
					$('#middlename').val(response.middle_name);
					$('#birthdate').val(response.birth_date);
					$('#year_graduated').val(response.batch_year);
					$('#degree').val(response.degree);
					$('#honors').val(response.honors);
					$('#profession').val(response.profession);
					$('#company').val(response.company_org);
					$('#address').val(response.address);
					$('#residence').val(response.residence);
					$('#telephone').val(response.telephone);
					$('#cellphone').val(response.cellphone);
					$('#email').val(response.email);
				},
				error: function(response) {
					Swal.fire({
						type: 'error',
						title: 'Ticket Number not found.',
						confirmButtonText: 'Okay',
					});
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