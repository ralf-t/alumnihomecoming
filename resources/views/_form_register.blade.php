<form method="POST" onsubmit="return Confirm()">
	{{ csrf_field() }}
	<div class="container-fluid px-0">
		<div class="row justify-content-center">
			<div class="col-4 pr-1">
				<label for="last_name">Last Name</label>
				<input type="text" class="form-control" id="last_name" name="last_name" required>
			</div>

			<div class="col-5 px-1">
				<label for="first_name">First Name</label>
				<input type="text" class="form-control" id="first_name" name="first_name" required>
			</div>

			<div class="col-3 pl-1">
				<label for="middle_name">Middle Name</label>
				<input type="text" class="form-control" id="middle_name" name="middle_name">
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-3 px-1">
				<label for="batch">Batch (Year)</label>
				<input type="text" name="batch_year" id="batch" class="form-control" required>
			</div>

			<div class="col-3 px-1">
				<label for="ticket">Ticket No.</label>
				<div class="input-group">
					<input type="text" class="form-control mb-0" id="ticket" name="ticket_no" required>
				</div>
				<small id="ticket_help" class="form-text mt-0 mb-2">For multiple tickets, separate by comma</small>
			</div>
		</div>
		<button class="btn reg form-control" id="submit" type="submit">Register</button>
	</div>
</form>