<?php

namespace App\Models\College;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutOff extends Model
{
    use HasFactory;

    protected $table = 'college_cut_offs';

    protected $fillable = ['heading','slug','college_id','long_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeCutOff($request)
    {
    	$request->validate([
            'heading'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:college_cut_offs,slug',
            'long_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$cut_offs = new CutOff(); 
        $cut_offs -> heading = request('heading');
        $cut_offs -> slug = request('slug');
        $cut_offs -> long_description = request('long_description');
        $cut_offs -> meta_name = request('meta_name');
        $cut_offs -> meta_description = request('meta_description');
        $cut_offs -> meta_keyword = request('meta_keyword');
        $cut_offs -> college_id = request('college_id');
        $cut_offs -> status = request('status');
        $cut_offs->save(); 
    }

    public static function editCutOff($request,$id)
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
        $cut_offs =  CutOff::find($id);
        $cut_offs -> heading = request('heading');
        $cut_offs -> slug = request('slug');
        $cut_offs -> long_description = request('long_description');
        $cut_offs -> meta_name = request('meta_name');
        $cut_offs -> meta_description = request('meta_description');
        $cut_offs -> meta_keyword = request('meta_keyword');
        $cut_offs -> college_id = request('college_id');
        $cut_offs -> status = request('status');
        $cut_offs->save(); 
    }
}
