@extends('_layout')

@section('body')
<div class="container-fluid px-0">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="card z-depth-3 mt-4">
				<div class="container-fluid px-0">
					<div class="row justify-content-center">
						<div class="col-11">
							<h3>Registered: 100</h3>
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
										<tr>
											<td>Hello</td>
											<td>World</td>
											<td><h4 style="color: green"><i class="fas fa-check-square"></i></h4></td>
											<td class="float-right">
												<button class="btn btn-light"><i class="fas fa-eye"></i></button>
												<button class="btn btn-primary"><i class="fas fa-edit"></i></button>
												<button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
											</td>
										</tr>
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