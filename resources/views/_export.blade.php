<table>
	<thead>
		<tr>
			<th colspan="7" style="font-weight:bold; text-align:center;">Alumni Homecoming Grand Reunion Guests Information</th>
		</tr>
		<tr>
			<th colspan="7" style="font-weight:bold;">Venue: Quezon City Sports Club</th>
		</tr>
		<tr>
			<th colspan="7" style="font-weight:bold;">Date and Time: September 28, 2019; 5:00PM - 12:00AM</th>
		</tr>
		<tr><td colspan="7"></td></tr>
		<tr>
			<th style="font-weight:bold; text-align:center;">Name</th>
			<th style="font-weight:bold; text-align:center;">Batch Year</th>
			<th style="font-weight:bold; text-align:center;">Birth Date</th>
			<th style="font-weight:bold; text-align:center;">Degree</th>
			<th style="font-weight:bold; text-align:center;">Address</th>
			<th style="font-weight:bold; text-align:center;">Contact Number</th>
			<th style="font-weight:bold; text-align:center;">Email</th>
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
		<tr><td colspan="7"></td></tr>
		<tr><td colspan="7"></td></tr>
		<tr>
			<td colspan="7">Retrieved from CCSS RnD Alumni Homecoming System 2019</td>
		</tr>
		<tr>
			<td colspan="7">{{ $timestamp }}</td>
		</tr>
	</tbody>
</table>