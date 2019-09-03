<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
