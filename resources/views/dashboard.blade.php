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
							<h3 class="mt-2">Overall Registered: {{ count($total) }}</h3>
							<h3 class="mt-2">Jubilarians: {{ count($jubilarians) }}</h3>

							<div>Platinum: {{ count($platinum) }}</div>
							<div>Blue Sapphire: {{count($blue_sapphire)}}</div>
							<div>Diamond: {{ count($diamond) }}</div>
							<div>Emerald: {{ count($emerald) }}</div>
							<div>Gold: {{ count($gold) }}</div>
							<div>Sapphire: {{ count($sapphire) }}</div>
							<div>Ruby: {{ count($ruby) }}</div>
							<div>Coral: {{ count($coral) }}</div>
							<div>Pearl: {{ count($pearl) }}</div>
							<div>Silver: {{ count($silver) }}</div>
							<div class="my-2">
								<form method="POST">
									{{ csrf_field() }}
									<div class="input-group w-75">
										<input type="search" value="{{ $request->search }}" class="form-control" name="search" placeholder="Search">
										<div class="input-group-append">
											<button class="btn btn-success" type="submit" title="search"><i class="fas fa-search"></i></button>
										</div>
									</div>
								</form>
							</div>
							<div class="table-responsive text-nowarp">
								<table class="table-hover table">
									<thead>
										<tr>
											<th class="th-lg" scope="col">Full Name</th>
											<th class="th-lg" scope="col">Ticket Number</th>
											<th class="th-lg" scope="col">Batch year</th>
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
												@if(floor($ticket->ticket_no / 10) == 0)
												000{{ $ticket->ticket_no }}
												@elseif (floor($ticket->ticket_no / 100) == 0)
												00{{ $ticket->ticket_no }}
												@elseif (floor($ticket->ticket_no / 1000) == 0)
												0{{ $ticket->ticket_no }}
												@else
												{{ $ticket->ticket_no }}
												@endif
												@endif
												@endforeach
											</td>
											<td>
												@foreach($jubi_years as $jubi_year)
												@if ($guest->batch_year == $jubi_year)
												Jubilarian **
												@endif
												@endforeach
												{{ $guest->batch_year }}
											</td>
											<td>
												@if($guest->raffle == 1)
												<h4 id="check"><i class="fas fa-check-square"></i></h4>
												@else
												<h4 id="ex"><i class="fas fa-times-circle"></i></h4>
												@endif
											</td>
											<td class="float-right">
												<button id="link-view" class="btn btn-light" title="View" data-id="{{ $guest->id }}" data-target="#modal-view" data-toggle="modal"><i class="fas fa-eye"></i></button>
												<a class="btn btn-primary" href="fillup/{{ $guest->id }}" title="Edit"><i class="fas fa-edit"></i></a>
												<button id="link-delete" class="btn btn-outline-danger" title="Delete" data-id="{{ $guest->id }}" data-target="#modal-delete" data-toggle="modal"><i class="fas fa-trash-alt"></i></button>
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
								@if($page == 0)
								{{ $guests->links() }}
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('_modal')
@endsection

@section('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
