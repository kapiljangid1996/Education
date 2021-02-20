<?php

namespace App\Models\College;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $table = 'college_admissions';

    protected $fillable = ['heading','slug','college_id','long_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeAdmission($request)
    {
    	$request->validate([
            'heading'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:college_admissions,slug',
            'long_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$admissions = new Admission(); 
        $admissions -> heading = request('heading');
        $admissions -> slug = request('slug');
        $admissions -> long_description = request('long_description');
        $admissions -> meta_name = request('meta_name');
        $admissions -> meta_description = request('meta_description');
        $admissions -> meta_keyword = request('meta_keyword');
        $admissions -> college_id = request('college_id');
        $admissions -> status = request('status');
        $admissions->save(); 
    }

    public static function editAdmission($request,$id)
    {
        $request->validate([
            'heading'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3',
            'long_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
        $admissions =  Admission::find($id);
        $admissions -> heading = request('heading');
        $admissions -> slug = request('slug');
        $admissions -> long_description = request('long_description');
        $admissions -> meta_name = request('meta_name');
        $admissions -> meta_description = request('meta_description');
        $admissions -> meta_keyword = request('meta_keyword');
        $admissions -> college_id = request('college_id');
        $admissions -> status = request('status');
        $admissions->save(); 
    }
}
