<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamOverview extends Model
{
    use HasFactory;

    protected $table = 'exam_overviews';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeOverview($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_overviews,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$overviews = new ExamOverview(); 
        $overviews -> name = request('name');
        $overviews -> slug = request('slug');
        $overviews -> long_description = request('long_description');
        $overviews -> short_description = request('short_description');
        $overviews -> meta_name = request('meta_name');
        $overviews -> meta_description = request('meta_description');
        $overviews -> meta_keyword = request('meta_keyword');
        $overviews -> exams_id = request('exams_id');
        $overviews -> status = request('status');
        $overviews->save(); 
    }

    public static function editOverview($request,$id)
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
        $overviews =  ExamOverview::find($id);
        $overviews -> name = request('name');
        $overviews -> slug = request('slug');
        $overviews -> long_description = request('long_description');
        $overviews -> short_description = request('short_description');
        $overviews -> meta_name = request('meta_name');
        $overviews -> meta_description = request('meta_description');
        $overviews -> meta_keyword = request('meta_keyword');
        $overviews -> exams_id = request('exams_id');
        $overviews -> status = request('status');
        $overviews->save(); 
    }
}
