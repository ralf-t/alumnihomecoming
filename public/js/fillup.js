$(function() {
	$('#info-card').hide();
	$('#loading').hide();

	document.getElementById('ticket').maxLength = '4';
	document.getElementById('year_graduated').maxLength = '4';

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
					$('#birthdate').val($.format.date(response.birth_date), "MMMM d, yyyy");
					$('#year_graduated').val(response.year_graduated);
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

	$('#year_graduated').keyup(function() {
		var year = $(this).val();
		if (isNaN(year)) {
			$(this).addClass('is-invalid');
			$('button[type="submit"]').attr('disabled', 'disabled');
		} else if (year.indexOf(" ") >= 0) {
			$(this).addClass('is-invalid');
			$('button[type="submit"]').attr('disabled', 'disabled');
		} else {
			$(this).removeClass('is-invalid');
			$('button[type="submit"]').removeAttr('disabled');
		}
	});
});