<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function login(Request $request) {
		$error = 0;
		$response = array();
		
		if (Auth::attempt($request->only(['username', 'password']))) {
			return redirect('dashboard');
		} else {
			$message = 'Invalid Username and/or Password.';
			$error ++;
			$response[0] = $message;
			$response[1] = $error;
			return view('login', [
				'response' => $response,
				'request' => $request
			]);
		}
	}

	public function logout(Request $request) {
		Auth::logout();
		return redirect('login');
	}
}
