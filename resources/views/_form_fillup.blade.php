<div class="row">
	<div class="col-5">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">Ticket Number</span>
			</div>
			<input type="text" class="form-control" id="ticket" name="ticket_no" @if(Request::is('fillup/*')) value="{{ $ticket->ticket_no }}" disabled @endif required>
		</div>
	</div>
	<div>
		<h4><i class="fas fa-spinner fa-spin" id="loading"></i></h4>
	</div>
</div>
<form method="POST" onsubmit="Success()">
	{{ csrf_field() }}
	<div id="info-card">
		<div class="row mt-2">
			<div class="col-4 pr-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Family Name</span>
					</div>
					<input type="text" class="form-control" id="lastname" name="last_name" @if(Request::is('fillup/*')) value="{{ $guest->last_name }}" @endif disabled>
				</div>
			</div>
			<div class="col-5 px-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Given Name</span>
					</div>
					<input type="text" class="form-control" id="firstname" name="first_name" @if(Request::is('fillup/*')) value="{{ $guest->first_name }}" @endif disabled>
				</div>
			</div>
			<div class="col-3 pl-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Middle Name</span>
					</div>
					<input type="text" class="form-control" id="middlename" name="middle_name" @if(Request::is('fillup/*')) value="{{ $guest->middle_name ?? '' }}" @endif disabled>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-5 pr-1">
				<div class="input-group dates">
					<div class="input-group-prepend">
						<span class="input-group-text">Birth Date</span>
					</div>
					<input type="text" id="birthdate" class="form-control" autocomplete="off" name="birth_date" placeholder="yyyy-mm-dd" @if(Request::is('fillup/*')) value="{{ $guest->birth_date ?? '' }}" @endif>
				</div>
			</div>
			<div class="col-7 pl-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Year Graduated</span>
					</div>
					<input type="text" class="form-control" id="year_graduated" name="year_graduated" @if(Request::is('fillup/*')) value="{{ $guest->batch_year }}" @endif disabled>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-6 pr-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Degree</span>
					</div>
					<input type="text" class="form-control" id="degree" name="degree" @if(Request::is('fillup/*')) value="{{ $guest->degree ?? '' }}" @endif>
				</div>
			</div>
			<div class="col-6 pl-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Honors</span>
					</div>
					<input type="text" class="form-control" id="honors" name="honors" @if(Request::is('fillup/*')) value="{{ $guest->honors ?? '' }}" @endif>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Profession / Job Title</span>
					</div>
					<input type="text" class="form-control" id="profession" name="profession" @if(Request::is('fillup/*')) value="{{ $guest->profession ?? '' }}" @endif>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Company Name / Organization</span>
					</div>
					<input type="text" class="form-control" id="company" name="company_org" @if(Request::is('fillup/*')) value="{{ $guest->company_org ?? '' }}" @endif>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Address</span>
					</div>
					<textarea name="address" id="address" class="form-control" rows="2">@if(Request::is('fillup/*')) {{ $guest->address ?? '' }} @endif</textarea>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Residence Address</span>
					</div>
					<textarea name="residence" id="residence" class="form-control" rows="2">@if(Request::is('fillup/*')) {{ $guest->residence ?? '' }} @endif</textarea>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-6 pr-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Telephone #</span>
					</div>
					<input type="text" class="form-control" id="telephone" name="telephone" @if(Request::is('fillup/*')) value="{{ $guest->telephone ?? '' }}" @endif>
				</div>
			</div>
			<div class="col-6 pl-1">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Cellphone #</span>
					</div>
					<input type="text" class="form-control" id="cellphone" name="cellphone" @if(Request::is('fillup/*')) value="{{ $guest->cellphone ?? '' }}" @endif>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Email Address</span>
					</div>
					<input type="text" class="form-control" id="email" name="email" @if(Request::is('fillup/*')) value="{{ $guest->email ?? '' }}" @endif>
				</div>
			</div>
		</div>
		<div class="row mt-3 justify-content-center">
			<div class="col-12 col-md-7 col-lg-4" id="buttons">
				<button class="btn btn-success" type="submit">Submit</button>
				<a class="btn btn-outline-danger" href="{{ url('dashboard') }}">Cancel</a>
			</div>
		</div>
	</div>
</form>