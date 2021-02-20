<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rating;

use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{
    public function store(Request $request){

    	if (Rating::where('user_id', '=', request('user_id'))->where('college_id', '=', request('college_id'))->first()) {
    		return back()->with('toast_error', 'Reviews Already Provided!');
		} else{
			auth()->user()->reviews()->create($request->all());
			return back()->with('toast_success', 'Thank You for the Review!');
		}    
    }
}
