<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCounselling extends Model
{
    use HasFactory;
    
    protected $table = 'exam_counsellings';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeCounselling($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_counsellings,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$counsellings = new ExamCounselling(); 
        $counsellings -> name = request('name');
        $counsellings -> slug = request('slug');
        $counsellings -> long_description = request('long_description');
        $counsellings -> short_description = request('short_description');
        $counsellings -> meta_name = request('meta_name');
        $counsellings -> meta_description = request('meta_description');
        $counsellings -> meta_keyword = request('meta_keyword');
        $counsellings -> exams_id = request('exams_id');
        $counsellings -> status = request('status');
        $counsellings->save(); 
    }

    public static function editCounselling($request,$id)
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
        $counsellings =  ExamCounselling::find($id);
        $counsellings -> name = request('name');
        $counsellings -> slug = request('slug');
        $counsellings -> long_description = request('long_description');
        $counsellings -> short_description = request('short_description');
        $counsellings -> meta_name = request('meta_name');
        $counsellings -> meta_description = request('meta_description');
        $counsellings -> meta_keyword = request('meta_keyword');
        $counsellings -> exams_id = request('exams_id');
        $counsellings -> status = request('status');
        $counsellings->save(); 
    }
}
