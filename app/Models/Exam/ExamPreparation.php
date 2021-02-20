<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPreparation extends Model
{
    use HasFactory;

    protected $table = 'exam_preparations';

    protected $fillable = ['name','slug','exams_id','long_description','short_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storePreparation($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:exam_preparations,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$preparations = new ExamPreparation(); 
        $preparations -> name = request('name');
        $preparations -> slug = request('slug');
        $preparations -> long_description = request('long_description');
        $preparations -> short_description = request('short_description');
        $preparations -> meta_name = request('meta_name');
        $preparations -> meta_description = request('meta_description');
        $preparations -> meta_keyword = request('meta_keyword');
        $preparations -> exams_id = request('exams_id');
        $preparations -> status = request('status');
        $preparations->save(); 
    }

    public static function editPreparation($request,$id)
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
        $preparations =  ExampreParation::find($id);
        $preparations -> name = request('name');
        $preparations -> slug = request('slug');
        $preparations -> long_description = request('long_description');
        $preparations -> short_description = request('short_description');
        $preparations -> meta_name = request('meta_name');
        $preparations -> meta_description = request('meta_description');
        $preparations -> meta_keyword = request('meta_keyword');
        $preparations -> exams_id = request('exams_id');
        $preparations -> status = request('status');
        $preparations->save(); 
    }
}
