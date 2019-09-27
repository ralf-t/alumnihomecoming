<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function login(Request $request) {
		if (Auth::attempt($request->only(['username', 'password']))) {
			return response()->json(['success' => true]);
		} else {
			return response()->json(['success' => false]);
		}
	}

	public function logout(Request $request) {
		Auth::logout();
		return redirect('login');
	}
}
