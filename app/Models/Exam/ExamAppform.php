<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAppform extends Model
{
    use HasFactory;

    protected $table = 'exam_appforms';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storeAppform($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_appforms,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$appforms = new ExamAppform(); 
        $appforms -> name = request('name');
        $appforms -> slug = request('slug');
        $appforms -> long_description = request('long_description');
        $appforms -> short_description = request('short_description');
        $appforms -> meta_name = request('meta_name');
        $appforms -> meta_description = request('meta_description');
        $appforms -> meta_keyword = request('meta_keyword');
        $appforms -> exams_id = request('exams_id');
        $appforms -> status = request('status');
        $appforms->save(); 
    }

    public static function editAppform($request,$id)
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
        $appforms =  ExamAppform::find($id);
        $appforms -> name = request('name');
        $appforms -> slug = request('slug');
        $appforms -> long_description = request('long_description');
        $appforms -> short_description = request('short_description');
        $appforms -> meta_name = request('meta_name');
        $appforms -> meta_description = request('meta_description');
        $appforms -> meta_keyword = request('meta_keyword');
        $appforms -> exams_id = request('exams_id');
        $appforms -> status = request('status');
        $appforms->save(); 
    }
}
