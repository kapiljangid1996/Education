<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = ['name','email','contact','city','tenth_Percent','twelfth_Percent','graduation_Percent','type','reg_id'];

    public static function storeInquiry($request){
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'email'  => 'required|email|unique:contacts,email',
            'contact'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:9,13',
        ]);

        $reg_id = Contact::max('reg_id');
        $reg_inc_id = $reg_id + 1;
		$inquiry = new Contact(); 
		$inquiry -> name = request('name');
		$inquiry -> email = request('email');
		$inquiry -> contact = request('contact');
		$inquiry -> city = request('city');
        $inquiry -> tenth_Percent = request('tenth_Percent');
        $inquiry -> twelfth_Percent = request('twelfth_Percent');
        $inquiry -> graduation_Percent = request('graduation_Percent');
		$inquiry -> reg_id = $reg_inc_id;
        $inquiry -> type = request('type');
		$inquiry->save();

        $data = array(
            'name'      =>  $request->name,
            'reg_id'   =>   $reg_inc_id
        );
        Mail::to($inquiry['email'])->send(new SendMail($data));
    }
}