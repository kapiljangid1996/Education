<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;

    protected $table = 'exam_questions';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeQuestion($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_questions,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$questions = new ExamQuestion(); 
        $questions -> name = request('name');
        $questions -> slug = request('slug');
        $questions -> long_description = request('long_description');
        $questions -> short_description = request('short_description');
        $questions -> meta_name = request('meta_name');
        $questions -> meta_description = request('meta_description');
        $questions -> meta_keyword = request('meta_keyword');
        $questions -> exams_id = request('exams_id');
        $questions -> status = request('status');
        $questions->save(); 
    }

    public static function editQuestion($request,$id)
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
        $questions =  ExamQuestion::find($id);
        $questions -> name = request('name');
        $questions -> slug = request('slug');
        $questions -> long_description = request('long_description');
        $questions -> short_description = request('short_description');
        $questions -> meta_name = request('meta_name');
        $questions -> meta_description = request('meta_description');
        $questions -> meta_keyword = request('meta_keyword');
        $questions -> exams_id = request('exams_id');
        $questions -> status = request('status');
        $questions->save(); 
    }
}
