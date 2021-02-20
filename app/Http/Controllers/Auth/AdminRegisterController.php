<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;
use Auth;

class AdminRegisterController extends Controller
{
    public function __construct()
    {
    	$this->middleware('guest:admin');
    }

    public function showRegisterForm()
    {
    	return view('auth.admin-register');
    }

    public function register(Request $request)
    {
    	$request->validate([
    		'name' => 'required|string|max:255',
    		'email' => 'required|email|unique:admins|string',
    		'avatar' => 'required',
    		'password' => 'required|min:8|string|confirmed',
    		'password_confirmation' => 'required|min:8|string', 
    	]);
    	if ($request->hasfile('avatar')){
    		$name = $request->get('name');
    		$imageName =$name.'-'.request()->avatar->getClientOriginalName();
    		request()->avatar->move(public_path('Uploads/Admin_Profile'), $imageName);
    	}
    	try{
    		$admin = Admin::create([
    			'name' => $request->name,
    			'email' => $request->email,
    			'password' => Hash::make($request->password),
    			'avatar' => $imageName,
    		]);
    		return \Redirect::to('admin/login')->with('success', 'Registration Successful.');    		
    	}
    	catch(\Exception $e){
    		return redirect()->back()->withInput($request->only('name','email'));
    	}
    }
}
