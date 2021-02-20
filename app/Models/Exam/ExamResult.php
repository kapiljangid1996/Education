<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $table = 'exam_results';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeResult($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_results,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$results = new ExamResult(); 
        $results -> name = request('name');
        $results -> slug = request('slug');
        $results -> long_description = request('long_description');
        $results -> short_description = request('short_description');
        $results -> meta_name = request('meta_name');
        $results -> meta_description = request('meta_description');
        $results -> meta_keyword = request('meta_keyword');
        $results -> exams_id = request('exams_id');
        $results -> status = request('status');
        $results->save(); 
    }

    public static function editResult($request,$id)
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
        $results =  ExamResult::find($id);
        $results -> name = request('name');
        $results -> slug = request('slug');
        $results -> long_description = request('long_description');
        $results -> short_description = request('short_description');
        $results -> meta_name = request('meta_name');
        $results -> meta_description = request('meta_description');
        $results -> meta_keyword = request('meta_keyword');
        $results -> exams_id = request('exams_id');
        $results -> status = request('status');
        $results->save(); 
    }
}
