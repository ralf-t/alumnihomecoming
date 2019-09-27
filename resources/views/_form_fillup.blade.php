<div class="row">
	<div class="col-5">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">Ticket Number</span>
			</div>
			<input type="text" class="form-control" id="ticket" name="ticket_no" required>
		</div>
	</div>
	<div>
		<h4><i class="fas fa-spinner fa-spin" id="loading"></i></h4>
	</div>
</div>
<form method="POST">
	{{ csrf_field() }}
	<div id="info-card">
		<div class="row mt-2">
			<div class="col-4 pr-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Family Name</span>
					</div>
					<input type="text" class="form-control" id="lastname" name="last_name" disabled>
				</div>
			</div>
			<div class="col-5 px-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Given Name</span>
					</div>
					<input type="text" class="form-control" id="firstname" name="first_name" disabled>
				</div>
			</div>
			<div class="col-3 pl-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Middle Name</span>
					</div>
					<input type="text" class="form-control" id="middlename" name="middle_name" disabled>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-5 pr-1">
				<div class="input-group dates">
					<div class="input-group-prepend">
						<span class="input-group-text">Birth Date</span>
					</div>
					<input type="text" id="birthdate" class="form-control" autocomplete="off" name="birth_date" placeholder="yyyy-mm-dd">
				</div>
			</div>
			<div class="col-7 pl-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Year Graduated</span>
					</div>
					<input type="text" class="form-control" id="year_graduated" name="year_graduated">
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-6 pr-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Degree</span>
					</div>
					<input type="text" class="form-control" id="degree" name="degree">
				</div>
			</div>
			<div class="col-6 pl-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Honors</span>
					</div>
					<input type="text" class="form-control" id="honors" name="honors">
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Profession/Job Title</span>
					</div>
					<input type="text" class="form-control" id="profession" name="profession">
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Company Name/Organization</span>
					</div>
					<input type="text" class="form-control" id="company" name="company_org">
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Address</span>
					</div>
					<textarea name="address" id="address" class="form-control" rows="2"></textarea>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Residence Address</span>
					</div>
					<textarea name="residence" id="residence" class="form-control" rows="2"></textarea>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-6 pr-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Telephone #</span>
					</div>
					<input type="text" class="form-control" id="telephone" name="telephone">
				</div>
			</div>
			<div class="col-6 pl-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Cellphone #</span>
					</div>
					<input type="text" class="form-control" id="cellphone" name="cellphone">
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Email Address</span>
					</div>
					<input type="text" class="form-control" id="email" name="email">
				</div>
			</div>
		</div>
		<div class="row mt-3 justify-content-center">
			<div class="col-12 col-md-7 col-lg-4" id="buttons">
				<button class="btn btn-success" type="submit">Submit</button>
				<a class="btn btn-outline-danger" href="{{ url('fillup') }}">Cancel</a>
			</div>
		</div>
	</div>
</form>