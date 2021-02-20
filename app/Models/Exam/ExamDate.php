<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDate extends Model
{
    use HasFactory;
    
    protected $table = 'exam_dates';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeDate($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_dates,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$date = new ExamDate(); 
        $date -> name = request('name');
        $date -> slug = request('slug');
        $date -> long_description = request('long_description');
        $date -> short_description = request('short_description');
        $date -> meta_name = request('meta_name');
        $date -> meta_description = request('meta_description');
        $date -> meta_keyword = request('meta_keyword');
        $date -> exams_id = request('exams_id');
        $date -> status = request('status');
        $date->save(); 
    }

    public static function editDate($request,$id)
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
        $dates =  ExamDate::find($id);
        $dates -> name = request('name');
        $dates -> slug = request('slug');
        $dates -> long_description = request('long_description');
        $dates -> short_description = request('short_description');
        $dates -> meta_name = request('meta_name');
        $dates -> meta_description = request('meta_description');
        $dates -> meta_keyword = request('meta_keyword');
        $dates -> exams_id = request('exams_id');
        $dates -> status = request('status');
        $dates->save(); 
    }
}
