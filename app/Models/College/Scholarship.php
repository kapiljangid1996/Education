<?php

namespace App\Models\College;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $table = 'college_scholarships';

    protected $fillable = ['heading','slug','college_id','long_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeScholarship($request)
    {
    	$request->validate([
            'heading'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:college_scholarships,slug',
            'long_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$scholarships = new Scholarship(); 
        $scholarships -> heading = request('heading');
        $scholarships -> slug = request('slug');
        $scholarships -> long_description = request('long_description');
        $scholarships -> meta_name = request('meta_name');
        $scholarships -> meta_description = request('meta_description');
        $scholarships -> meta_keyword = request('meta_keyword');
        $scholarships -> college_id = request('college_id');
        $scholarships -> status = request('status');
        $scholarships->save(); 
    }

    public static function editScholarship($request,$id)
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
        $scholarships =  Scholarship::find($id);
        $scholarships -> heading = request('heading');
        $scholarships -> slug = request('slug');
        $scholarships -> long_description = request('long_description');
        $scholarships -> meta_name = request('meta_name');
        $scholarships -> meta_description = request('meta_description');
        $scholarships -> meta_keyword = request('meta_keyword');
        $scholarships -> college_id = request('college_id');
        $scholarships -> status = request('status');
        $scholarships->save(); 
    }
}
