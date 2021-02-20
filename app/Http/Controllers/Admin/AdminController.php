<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewsletterMail;

use App\Models\Contact;
use App\Models\Newsletter;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

   	public function index()
    {
        return view('admin.index');
    }

   	public function contactList()
    {
    	$contacts = Contact::all();
        return view('admin.contact')->with('contacts', $contacts);
    }

    public function newsletterList()
    {
        $newsletters = Newsletter::all();
        return view('admin.newsletter')->with('newsletters', $newsletters);
    }

    public function newsletterSend(Request $request)
    {   
        $val = $request->check_email;
        foreach ($val as $key => $value) {

            $newsletter = Newsletter::where('id', $value)->pluck('email');

            $data = array(
                'unique_id' => encrypt($value)
            );

            Mail::to($newsletter[0])->send(new SendNewsletterMail($data));

            $newsletters = Newsletter::find($value);
            $newsletters -> subscription = 1;
            $newsletters->save();
        }     

        return redirect()->back()->with('toast_success','Thank You!');
    }
}
