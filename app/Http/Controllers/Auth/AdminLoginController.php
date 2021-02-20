<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
	{
		$this->middleware('guest:admin')->except('logout');
	}

	public function showLoginForm()
	{
		return view('auth.admin-login');
	}

	public function login(Request $request)
	{
		$request->validate([
 		'email' => 'email|required|string',
 		'password' => 'required|string|min:8',
   	]);

	 	if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
	 	{
	 		return redirect()->intended('/')->with('success','Welcome');
	 	}

	 	return redirect()->back()->with($request->only('email','remember'))->with('toast_error','Credentials Not Match');
	}

	public function logout(Request $request)
	{
		Auth::guard('admin')->logout();
		return redirect('/');
	}
}
