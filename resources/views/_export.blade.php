<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Batch Year</th>
			<th>Birth Date</th>
			<th>Degree</th>
			<th>Address</th>
			<th>Contact Number</th>
			<th>Email</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($guests as $guest)
		<tr>
			<td>{{ $guest->last_name }}, {{ $guest->first_name }} @if($guest->middle_name != null){{ $guest->middle_name }}@endif</td>
			<td>{{ $guest->batch_year }}</td>
			<td>{{ \Carbon\Carbon::parse($guest->birth_date)->isoFormat('MMMM D, YYYY') }}</td>
			<td>{{ $guest->degree }}</td>
			<td>{{ $guest->address }}</td>
			<td>{{ $guest->cellphone }}</td>
			<td>{{ $guest->email }}</td>
		</tr>
		@endforeach
		<tr></tr>
		<tr></tr>
		<tr>
			<td>Retrieved from CCSS RnD Alumni Homecoming System 2019</td>
		</tr>
		<tr>
			<td>{{ $timestamp }}</td>
		</tr>
	</tbody>
</table>