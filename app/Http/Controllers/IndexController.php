<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;

class IndexController extends Controller
{
	public function register() {
		return view('register');
	}

	public function dashboard() {
		return view('dashboard');
	}

	public function raffle() {
		return view('raffle');
	}

	public function fillup() {
		return view('fillup');
	}

	// public function validate() {
	// 	$guests = Guest::all();
	// 	return $guests;
	// }
}
