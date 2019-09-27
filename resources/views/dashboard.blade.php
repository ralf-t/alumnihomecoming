@extends('_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('body')
<div class="container-fluid px-0">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="card z-depth-3 mt-4">
				<div class="container-fluid px-0">
					<div class="row justify-content-center">
						<div class="col-11 mt-3">
							<h3 class="mt-2">Registered: 100</h3>
							<div class="my-2">
								<form method="POST">
									{{ csrf_field() }}
									<div class="input-group w-100">
										<input type="search" class="form-control" name="search" placeholder="Search">
										<button class="btn btn-outline-success" type="submit" title="search"><i class="fas fa-search"></i></button>
									</div>
								</form>
							</div>
							<div class="table-responsive text-nowarp">
								<table class="table-hover table">
									<thead>
										<tr>
											<th class="th-lg" scope="col">Full Name</th>
											<th class="th-lg" scope="col">Ticket Number</th>
											<th class="th-lg" scope="col">Raffle Entry</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@if(count($guests) > 0)
										@foreach($guests as $guest)
										<tr>
											<td>{{ $guest->last_name }}, {{ $guest->first_name }} @if($guest->middle_name != null) {{ $guest->middle_name }} @endif</td>
											<td>
												@foreach($tickets as $ticket)
												@if($guest->id == $ticket->guest_id)
												{{ $ticket->ticket_no }} 
												@endif
												@endforeach
											</td>
											<td>
												@if($guest->raffle == 1)
												<h4 id="check"><i class="fas fa-check-square"></i></h4>
												@else
												<h4 id="ex"><i class="fas fa-times-circle"></i></h4>
												@endif
											</td>
											<td class="float-right">
												<button class="btn btn-light"><i class="fas fa-eye"></i></button>
												<a class="btn btn-primary" href="fillup/{{ $guest->id }}"><i class="fas fa-edit"></i></a>
												<button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
											</td>
										</tr>
										@endforeach
										@else
										<tr>
											<td>No guests found.</td>
										</tr>
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection