<?php

namespace App\Models\College;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFee extends Model
{
    use HasFactory;

    protected $table = 'college_course_fees';

    protected $fillable = ['name','slug','course_id','fee','college_id','duration','seats','long_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public function course()
    {
        return $this->belongsTo('App\Models\Course\Course');
    }

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam\Exam');
    }

    public function coursefee_exam()
    {
        return $this->hasMany('App\Models\College\Coursefee_Exam');
    }

    public static function storeCourseFee($request)
    {
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:college_course_fees,slug',
            'fee'  => 'required',
            'duration'  => 'required',
            'seats'  => 'required',
            'long_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$course_fees = new CourseFee(); 
        $course_fees -> course_id = request('course_id');
        $course_fees -> name = request('name');
        $course_fees -> slug = request('slug');
        $course_fees -> fee = request('fee');
        $course_fees -> duration = request('duration');
        $course_fees -> seats = request('seats');
        $course_fees -> long_description = request('long_description');
        $course_fees -> meta_name = request('meta_name');
        $course_fees -> meta_description = request('meta_description');
        $course_fees -> meta_keyword = request('meta_keyword');
        $course_fees -> college_id = request('college_id');
        $course_fees -> status = request('status');
        $course_fees->save(); 

        $lastInsertedId= $course_fees->id;

        if (!empty($exam_ids=$request->input('exam_id'))){
            foreach($exam_ids as $id_exam){
                $coursefeeexamids = new Coursefee_Exam();
                $coursefeeexamids -> course_fee_id = $lastInsertedId; 
                $coursefeeexamids -> exam_id = $id_exam; 
                $coursefeeexamids->save(); 
            }
        }
    }

    public static function editCourseFee($request,$id)
    {
        $request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3',
            'fee'  => 'required',
            'duration'  => 'required',
            'seats'  => 'required',
            'long_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
        $course_fees =  CourseFee::find($id);
        $course_fees -> course_id = request('course_id');
        $course_fees -> name = request('name');
        $course_fees -> slug = request('slug');
        $course_fees -> fee = request('fee');
        $course_fees -> duration = request('duration');
        $course_fees -> seats = request('seats');
        $course_fees -> long_description = request('long_description');
        $course_fees -> meta_name = request('meta_name');
        $course_fees -> meta_description = request('meta_description');
        $course_fees -> meta_keyword = request('meta_keyword');
        $course_fees -> college_id = request('college_id');
        $course_fees -> status = request('status');
        $course_fees->save(); 

        $id_course_fee = $request->input('course_fee_id');

        Coursefee_Exam::where('course_fee_id',$id_course_fee)->delete();

        if (!empty($exam_ids=$request->input('exam_id'))){
            foreach($exam_ids as $id_exam){
                $coursefeeexamids = new Coursefee_Exam();
                $coursefeeexamids -> course_fee_id = $request->input('course_fee_id'); 
                $coursefeeexamids -> exam_id = $id_exam; 
                $coursefeeexamids->save(); 
            }
        }
    }
}
