<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course\Course;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$courses = Course::with('category')->get();
        return view('admin.course.index')->with('courses',$courses);
    }

    public function create()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.course.add')->with('categories',$categories);
    }

    public function store(Request $request)
    {
        $course = Course::storeCourse($request);
        return redirect()->route('course.index')->with('success','Course Created!');
    }

    public function edit($id)
    {
        $courses = Course::with('category')->find($id);
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.course.edit')->with('categories',$categories)->with('courses',$courses);
    }

    public function update(Request $request, $id)
    {   
        $course = Course::editCourse($request,$id);
        return redirect()->route('course.index')->with('success','Course Updated!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('course.index')->with('success','Course Deleted!');
    }
}
