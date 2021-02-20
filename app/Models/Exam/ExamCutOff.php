<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCutOff extends Model
{
    use HasFactory;
    
    protected $table = 'exam_cutoffs';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeCutoff($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_cutoffs,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$cutoffs = new ExamCutOff(); 
        $cutoffs -> name = request('name');
        $cutoffs -> slug = request('slug');
        $cutoffs -> long_description = request('long_description');
        $cutoffs -> short_description = request('short_description');
        $cutoffs -> meta_name = request('meta_name');
        $cutoffs -> meta_description = request('meta_description');
        $cutoffs -> meta_keyword = request('meta_keyword');
        $cutoffs -> exams_id = request('exams_id');
        $cutoffs -> status = request('status');
        $cutoffs->save(); 
    }

    public static function editCutoff($request,$id)
    {
        $request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
        $cutoffs =  ExamCutOff::find($id);
        $cutoffs -> name = request('name');
        $cutoffs -> slug = request('slug');
        $cutoffs -> long_description = request('long_description');
        $cutoffs -> short_description = request('short_description');
        $cutoffs -> meta_name = request('meta_name');
        $cutoffs -> meta_description = request('meta_description');
        $cutoffs -> meta_keyword = request('meta_keyword');
        $cutoffs -> exams_id = request('exams_id');
        $cutoffs -> status = request('status');
        $cutoffs->save(); 
    }
}
