<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = ['name','slug','category_id','long_description','short_description','image','meta_name','meta_description','meta_keyword','sort_order','status'];

    public function category()
    {
    	return $this->belongsTo('App\Models\Category');
    }

    public static function storeCourse($request)
    {
    	$request->validate([
            'name'  => 'required|max:255|string',
            'slug'  => 'required|unique:courses,slug',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
        $courses = new Course(); 
        $courses -> name = request('name');
        $courses -> slug = request('slug');
        $courses -> category_id = request('category_id');
        $courses -> long_description = request('long_description');
        $courses -> short_description = request('short_description');
        $courses -> meta_name = request('meta_name');
        $courses -> meta_description = request('meta_description');
        $courses -> meta_keyword = request('meta_keyword');
        $courses -> status = request('status');
        if (request()->hasfile('image'))
        {
            $imageName =$request->get('slug')."-".request()->image->getClientOriginalName();
            request()->image->move(public_path('Uploads/Course'), $imageName); 
            $courses->image = $imageName;
        }
        $courses->save();
    }

    public static function editCourse($request,$id)
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
        $courses = Course::find($id);
        $courses -> name = $request->input('name');
        $courses -> slug = $request->input('slug');
        $courses -> category_id = $request->input('category_id');
        $courses -> long_description = $request->input('long_description');
        $courses -> short_description = $request->input('short_description');
        $courses -> meta_name = $request->input('meta_name');
        $courses -> meta_description = $request->input('meta_description');
        $courses -> meta_keyword = $request->input('meta_keyword');
        $courses -> status = $request->input('status');
        $old_image = $request->input('old_image');
        if ($request->hasfile('image'))
        {
            if(!empty($old_image))
            {
                unlink(public_path("Uploads/Course/{$old_image}"));
            }
            $slug = $request->get('slug');
            $imageName =$slug.'-'.request()->image->getClientOriginalName();
            request()->image->move(public_path('Uploads/Course'), $imageName); 
            $courses->image = $imageName;
        }
        $courses->save();
    }
}
