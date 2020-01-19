@extends('_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('body')
<div class="container px-0">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="card z-depth-3 mt-4">
				<div class="container px-0">
					<div class="row justify-content-center">
						<div class="col-11 mt-3">
							<div class="clearfix">
								<h3 class="mt-2 float-left">Overall Registered: {{ count($total) }}</h3>
								<a class="btn btn-danger float-right ml-2" href="{{ url('logout') }}"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
								<a href="{{ url('export') }}" class="btn btn-success float-right"><i class="fas fa-file-excel mr-2"></i>Export</a>
							</div>
							<h3 class="mt-2">Jubilarians: {{ count($jubilarians) }}</h3>
							<table id="jubilarians">
								<tr>
									<td>
										<div>Platinum: <span class="float-right mr-4">{{ count($platinum) }}</span></div>
									</td>
									<td>
										<div>Gold: <span class="float-right mr-4">{{ count($gold) }}</span></div>
									</td>
									<td>
										<div>Coral: <span class="float-right mr-4">{{ count($coral) }}</span></div>
									</td>
								</tr>
								<tr>
									<td>
										<div>Blue Sapphire: <span class="float-right mr-4">{{count($blue_sapphire)}}</div></span>
									</td>
									<td>
										<div>Sapphire: <span class="float-right mr-4">{{ count($sapphire) }}</span></div>
									</td>
									<td>
										<div>Pearl: <span class="float-right mr-4">{{ count($pearl) }}</span></div>
									</td>
								</tr>
								<tr>
									<td>
										<div>Diamond: <span class="float-right mr-4">{{ count($diamond) }}</span></div>
									</td>
									<td>
										<div>Ruby: <span class="float-right mr-4">{{ count($ruby) }}</span></div>
									</td>
									<td>
										<div>Silver: <span class="float-right mr-4">{{ count($silver) }}</span></div>
									</td>
								</tr>
								<tr>
									<td>
										<div>Emerald: <span class="float-right mr-4">{{ count($emerald) }}</span></div>
									</td>
								</tr>
							</table>
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
											<th scope="col">Full Name</th>
											<th scope="col">Ticket Number</th>
											<th width="150" scope="col">Batch year</th>
											<th width="125" scope="col">Raffle Entry</th>
											<th width="175" scope="col"></th>
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
