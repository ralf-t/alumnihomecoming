<?php

namespace App\Exports;

use App\Guest;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GuestsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('_export', [
		'guests' => Guest::all()
	]);
    }
}
