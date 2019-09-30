<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Guest;
use App\Ticket;
use Carbon\Carbon;
use App\Exports\GuestsExport;
use Maatwebsite\Excel\Facades\Excel;

class IndexController extends Controller
{
	public function register() {
		return view('register');
	}

	public function dashboard(Request $request) {
		$page = 0;
		$jubi_years = [1949, 1959, 1969, 1979, 1989, 1954, 1964, 1974, 1984, 1994];
		$platinum = Guest::where('batch_year', '=', 1949)->get();
		$blue_sapphire = Guest::where('batch_year', '=', 1954)->get();
		$diamond = Guest::where('batch_year', '=', 1959)->get();
		$emerald = Guest::where('batch_year', '=', 1964)->get();
		$gold = Guest::where('batch_year', '=', 1969)->get();
		$sapphire = Guest::where('batch_year', '=', 1974)->get();
		$ruby = Guest::where('batch_year', '=', 1979)->get();
		$coral = Guest::where('batch_year', '=', 1984)->get();
		$pearl = Guest::where('batch_year', '=', 1989)->get();
		$silver = Guest::where('batch_year', '=', 1994)->get();
		if ($request->search) {
			$guests = Guest::where('first_name', 'LIKE', '%' . $request->search . '%')
			->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
			->orWhere('middle_name', 'LIKE', '%' . $request->search . '%')
			->orWhere('batch_year', 'LIKE', '%' . $request->search . '%')
			->orWhere('degree', 'LIKE', '%' . $request->search . '%')
			->orWhere('honors', 'LIKE', '%' . $request->search . '%')
			->orWhere('profession', 'LIKE', '%' . $request->search . '%')
			->orWhere('company_org', 'LIKE', '%' . $request->search . '%')
			->orWhere('address', 'LIKE', '%' . $request->search . '%')
			->orWhere('residence', 'LIKE', '%' . $request->search . '%')
			->orWhere('telephone', 'LIKE', '%' . $request->search . '%')
			->orWhere('cellphone', 'LIKE', '%' . $request->search . '%')
			->orWhere('email', 'LIKE', '%' . $request->search . '%')
			->get();
			$page ++;
		} else {
			$guests = Guest::orderBy('updated_at', 'desc')->paginate(10);
		}
		$total = Guest::all();
		$jubilarians = Guest::whereIn('batch_year', $jubi_years)->get();
		$tickets = Ticket::all();
//		$prefix = "";
//		foreach ($tickets as $ticket) {
//			sprintf('%04d' ,$ticket->ticket_no);
//			if (floor($ticket->ticket_no / 10) == 0) {
//				$prefix = "000";
//			} else if (floor($ticket->ticket_no / 100) == 0) {
//				$prefix = "00";
//			} else if (floor($ticket->ticket_no / 1000) == 0) {
//				$prefix = "0";
//			}
//			$ticket->ticket_no = $prefix + (string)$ticket->ticket_no;
//		}
		return view('dashboard', [
			'guests' => $guests,
			'tickets' => $tickets,
			'total' => $total,
			'request' => $request,
			'page' => $page,
			'jubilarians' => $jubilarians,
			'jubi_years' => $jubi_years,
			'platinum' => $platinum,
			'blue_sapphire' => $blue_sapphire,
			'diamond' => $diamond,
			'emerald' => $emerald,
			'gold' => $gold,
			'sapphire' => $sapphire,
			'ruby' => $ruby,
			'coral' => $coral,
			'pearl' => $pearl,
			'silver' => $silver,
		]);
	}

	public function raffle() {
		return view('raffle');
	}

	public function fillup() {
		return view('fillup');
	}

	public function login() {
		if (Auth::user()) {
			return redirect('dashboard');
		} else {
			$response = array();
			$response[0] = '';
			$response[1] = 0;
			return view('login', [
				'response' => $response,
			]);
		}
	}

	public function report() {
		$timestamp = Carbon::now('+8:00');

		return Excel::download(new GuestsExport, 'Alumni Homecoming Grand Reunion Guests Information ' . $timestamp . '.xlsx');
	}

	public function validation($ticket) {
		$duplicates = Ticket::where('ticket_no', '=', $ticket)->get();
		if (count($duplicates) > 0) {
			return '1';
		} else {
			return '0';
		}
	}

	public function guest_id($ticket) {
		$ticket = Ticket::where('ticket_no', '=', $ticket)->get();
		$guest = Guest::where('id', '=', $ticket[0]->guest_id)->get();
		if ($guest[0]->birth_date != null) {
			$guest[0]->birth_date = Carbon::parse($guest[0]->birth_date)->isoFormat('MMMM D, YYYY');
		}
		return $guest[0];
	}
}
