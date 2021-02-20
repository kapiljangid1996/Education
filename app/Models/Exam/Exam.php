<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';

    protected $fillable = ['exam_name','exam_slug','exam_description','exam_short_description','meta_name','meta_description','meta_keyword','status'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public static function storeExam($request)
    {
        $request->validate([
            'name'  => 'required|max:255|string',
            'slug'  => 'required|unique:exams,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
        $exams = new Exam(); 
        $exams -> name = request('name');
        $exams -> slug = request('slug');
        $exams -> long_description = request('long_description');
        $exams -> short_description = request('short_description');
        $exams -> meta_name = request('meta_name');
        $exams -> meta_description = request('meta_description');
        $exams -> meta_keyword = request('meta_keyword');
        $exams -> status = request('status');
        if (request()->hasfile('image'))
        {
            $imageName =$request->get('slug')."-".request()->image->getClientOriginalName();
            request()->image->move(public_path('Uploads/Exam'), $imageName); 
            $exams->image = $imageName;
        }
        $exams->save();
    }

    public static function editExam($request,$id)
    {
        $request->validate([
            'name'  => 'required|max:255|string',
            'slug'  => 'required',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
        $exams = Exam::find($id);
        $exams -> name = $request->input('name');
        $exams -> slug = $request->input('slug');
        $exams -> long_description = $request->input('long_description');
        $exams -> short_description = $request->input('short_description');
        $exams -> meta_name = $request->input('meta_name');
        $exams -> meta_description = $request->input('meta_description');
        $exams -> meta_keyword = $request->input('meta_keyword');
        $exams -> status = $request->input('status');
        $old_image = $request->input('old_image');
        if ($request->hasfile('image'))
        {
            if(!empty($old_image))
            {
                unlink(public_path("Uploads/Exam/{$old_image}"));
            }
            $slug = $request->get('slug');
            $imageName =$slug.'-'.request()->image->getClientOriginalName();
            request()->image->move(public_path('Uploads/Exam'), $imageName); 
            $exams->image = $imageName;
        }
        $exams->save();
    }
}
