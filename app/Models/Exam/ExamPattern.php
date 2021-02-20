<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPattern extends Model
{
    use HasFactory;

    protected $table = 'exam_patterns';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storePattern($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_patterns,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$patterns = new ExamPattern(); 
        $patterns -> name = request('name');
        $patterns -> slug = request('slug');
        $patterns -> long_description = request('long_description');
        $patterns -> short_description = request('short_description');
        $patterns -> meta_name = request('meta_name');
        $patterns -> meta_description = request('meta_description');
        $patterns -> meta_keyword = request('meta_keyword');
        $patterns -> exams_id = request('exams_id');
        $patterns -> status = request('status');
        $patterns->save(); 
    }

    public static function editPattern($request,$id)
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
        $patterns =  ExamPattern::find($id);
        $patterns -> name = request('name');
        $patterns -> slug = request('slug');
        $patterns -> long_description = request('long_description');
        $patterns -> short_description = request('short_description');
        $patterns -> meta_name = request('meta_name');
        $patterns -> meta_description = request('meta_description');
        $patterns -> meta_keyword = request('meta_keyword');
        $patterns -> exams_id = request('exams_id');
        $patterns -> status = request('status');
        $patterns->save(); 
    }
}
