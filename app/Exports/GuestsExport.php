<?php

namespace App\Exports;

use App\Guest;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class GuestsExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('_export', [
            'guests' => Guest::all(),
            'timestamp' => Carbon::now(),
        ]);
    }
}
