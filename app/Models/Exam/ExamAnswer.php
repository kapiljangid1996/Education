<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    use HasFactory;

    protected $table = 'exam_answers';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeAnswer($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_answers,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$answers = new ExamAnswer(); 
        $answers -> name = request('name');
        $answers -> slug = request('slug');
        $answers -> long_description = request('long_description');
        $answers -> short_description = request('short_description');
        $answers -> meta_name = request('meta_name');
        $answers -> meta_description = request('meta_description');
        $answers -> meta_keyword = request('meta_keyword');
        $answers -> exams_id = request('exams_id');
        $answers -> status = request('status');
        $answers->save(); 
    }

    public static function editAnswer($request,$id)
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
        $answers =  ExamAnswer::find($id);
        $answers -> name = request('name');
        $answers -> slug = request('slug');
        $answers -> long_description = request('long_description');
        $answers -> short_description = request('short_description');
        $answers -> meta_name = request('meta_name');
        $answers -> meta_description = request('meta_description');
        $answers -> meta_keyword = request('meta_keyword');
        $answers -> exams_id = request('exams_id');
        $answers -> status = request('status');
        $answers->save(); 
    }
}
