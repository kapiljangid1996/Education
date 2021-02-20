<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSyllabus extends Model
{
    use HasFactory;
    
    protected $table = 'exam_syllabi';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeSyllabus($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_syllabi,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$syllabi = new ExamSyllabus(); 
        $syllabi -> name = request('name');
        $syllabi -> slug = request('slug');
        $syllabi -> long_description = request('long_description');
        $syllabi -> short_description = request('short_description');
        $syllabi -> meta_name = request('meta_name');
        $syllabi -> meta_description = request('meta_description');
        $syllabi -> meta_keyword = request('meta_keyword');
        $syllabi -> exams_id = request('exams_id');
        $syllabi -> status = request('status');
        $syllabi->save(); 
    }

    public static function editSyllabus($request,$id)
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
        $syllabi =  ExamSyllabus::find($id);
        $syllabi -> name = request('name');
        $syllabi -> slug = request('slug');
        $syllabi -> long_description = request('long_description');
        $syllabi -> short_description = request('short_description');
        $syllabi -> meta_name = request('meta_name');
        $syllabi -> meta_description = request('meta_description');
        $syllabi -> meta_keyword = request('meta_keyword');
        $syllabi -> exams_id = request('exams_id');
        $syllabi -> status = request('status');
        $syllabi->save(); 
    }
}
