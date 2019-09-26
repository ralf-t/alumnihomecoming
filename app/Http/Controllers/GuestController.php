<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;
use App\Ticket;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()){
            return view('dashboard');
        } else {
            $confirmed = Guest::where('raffle', '=', '0')
            ->pluck('id');
            $tickets = Ticket::whereIn('guest_id', $confirmed)
            ->pluck('ticket_no');
            return $tickets;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guest = new Guest;
        $guest->fill($request->only([
            'first_name',
            'last_name',
            'middle_name',
            'batch_year',
            'honors',
            'profession',
            'company_org',
            'year_graduated',
            'address',
            'residence',
            'telephone',
            'cellphone',
            'email',
            'degree',
        ]));

        $guest->save();

        $ticket = new Ticket;
        $ticket->fill($request->only([
            'ticket_no',
        ]));

        // $ticket_array = explode(',', $request->ticket_no);
        // return $ticket_array;

        // $ticket->ticket_no
        $ticket->guest_id = $guest->id;
        $ticket->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guest = Guest::find($id);
        return $guest;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
