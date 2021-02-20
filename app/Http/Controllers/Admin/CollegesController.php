<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\State;
use App\Models\Course\Course;
use App\Models\Exam\Exam;
use App\Models\College\College;
use App\Models\College\College_Category;
use App\Models\College\CourseFee;
use App\Models\College\Admission;
use App\Models\College\Placement;
use App\Models\College\CutOff;
use App\Models\College\Infrastructure;
use App\Models\College\Scholarship;
use App\Models\College\Coursefee_Exam;
use File;

class CollegesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$colleges = College::with('category_list.category_name')->orderBy('id', 'desc')->get();
        return view('admin.college.index')->with('colleges',$colleges);
    }

    public function create()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $state_list = State::all();
        return view('admin.college.add')->with('categories',$categories)->with('state_list',$state_list);
    }

    public function store(Request $request)
    {
        $colleges = College::storeCollege($request);
        return redirect()->route('college.index')->with('success','College Created!');
    }

    public function edit($id)
    {
        $colleges = College::with('category_list')->find($id);
        $state_list = State::all();
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.college.edit')->with('categories',$categories)->with('colleges',$colleges)->with('state_list',$state_list);
    }

    public function update(Request $request, $id)
    {   
        $colleges = College::editCollege($request,$id);
        return redirect()->route('college.index')->with('success','College Updated!');
    }

    public function destroy($id)
    {
        College_Category::where('college_id',$id)->delete();
        CourseFee::where('college_id',$id)->delete();
        Admission::where('college_id',$id)->delete();
        Placement::where('college_id',$id)->delete();
        CutOff::where('college_id',$id)->delete();
        Infrastructure::where('college_id',$id)->delete();
        $colleges = College::findOrFail($id);
        if(!empty($colleges) && !empty($colleges['image']) && !empty($colleges['logo'])){
            $files = array("public/Uploads/College/Image/".$colleges['image'],"public/Uploads/College/Image/400x200/".$colleges['image'], "public/Uploads/College/Logo/".$colleges['logo'],"public/Uploads/College/Logo/55x55/".$colleges['logo']);
            File::delete($files);
        }
        $colleges->delete();
        return redirect()->route('college.index')->with('success','College Record Deleted!');
    }

    //---------------------------------- College Course & Fees -----------------------------------------

    public function collegeCourseFee($id)
    {
        $course_fees = CourseFee::with('course')->with('exam')->with('coursefee_exam')->where('college_id', '=', $id)->get();
        $exams = Exam::where('status', '=', 1)->get();
        return view('admin.college.course_fee.index')->with('id',$id)->with('course_fees',$course_fees)->with('exams',$exams);
    }

    public function collegeCourseFeeCreateForm($id)
    {
        $courses = Course::where('status', '=', 1)->get();
        $exams = Exam::where('status', '=', 1)->get();
        return view('admin.college.course_fee.add')->with('id',$id)->with('courses',$courses)->with('exams',$exams);
    }

    public function collegeCourseFeeCreate(Request $request)
    {
        $course_fees = CourseFee::storeCourseFee($request);
        return \Redirect::to('admin/college/course_fees/'.request('college_id'))->with('success','Course & Fees Created!');
    }

    public function collegeCourseFeeEditForm($id)
    {
        $course_fees = CourseFee::with('course')->with('exam')->with('coursefee_exam')->find($id);
        $courses = Course::where('status', '=', 1)->get();
        $exams = Exam::where('status', '=', 1)->get();
        return view('admin.college.course_fee.edit')->with('id',$id)->with('course_fees',$course_fees)->with('courses',$courses)->with('exams',$exams);
    }

    public function collegeCourseFeeEdit(Request $request, $id)
    {   
        $course_fees = CourseFee::editCourseFee($request, $id);
        return \Redirect::to('admin/college/course_fees/'.request('college_id'))->with('success','Course & Fees Updated!');
    }

    public function collegeCourseFeeDelete($id)
    {   
        $course_fees = CourseFee::findOrFail($id);
        $course_fees->delete();
        return \Redirect::to('admin/college/course_fees/'.$course_fees->college_id)->with('success','Course & Fees Deleted!');
    }

    //---------------------------------- College Admissions -----------------------------------------

    public function collegeAdmission($id)
    {
        $admissions = Admission::where('college_id', '=', $id)->get();
        return view('admin.college.admission.index')->with('id',$id)->with('admissions',$admissions);
    }

    public function collegeAdmissionCreateForm($id)
    {
        return view('admin.college.admission.add')->with('id',$id);
    }

    public function collegeAdmissionCreate(Request $request)
    {
        $admissions = Admission::storeAdmission($request);
        return \Redirect::to('admin/college/admissions/'.request('college_id'))->with('success','Admissions Created!');
    }

    public function collegeAdmissionEditForm($id)
    {
        $admissions = Admission::find($id);
        return view('admin.college.admission.edit')->with('id',$id)->with('admissions',$admissions);
    }

    public function collegeAdmissionEdit(Request $request, $id)
    {   
        $admissions = Admission::editAdmission($request, $id);
        return \Redirect::to('admin/college/admissions/'.request('college_id'))->with('success','Admissions Updated!');
    }

    public function collegeAdmissionDelete($id)
    {   
        $admissions = Admission::findOrFail($id);
        $admissions->delete();
        return \Redirect::to('admin/college/admissions/'.$admissions->college_id)->with('success','Admissions Deleted!');
    }

    //---------------------------------- College Placements -----------------------------------------

    public function collegePlacement($id)
    {
        $placements = Placement::where('college_id', '=', $id)->get();
        return view('admin.college.placement.index')->with('id',$id)->with('placements',$placements);
    }

    public function collegePlacementCreateForm($id)
    {
        return view('admin.college.placement.add')->with('id',$id);
    }

    public function collegePlacementCreate(Request $request)
    {
        $placements = Placement::storePlacement($request);
        return \Redirect::to('admin/college/placements/'.request('college_id'))->with('success','Placements Created!');
    }

    public function collegePlacementEditForm($id)
    {
        $placements = Placement::find($id);
        return view('admin.college.placement.edit')->with('id',$id)->with('placements',$placements);
    }

    public function collegePlacementEdit(Request $request, $id)
    {   
        $placements = Placement::editPlacement($request, $id);
        return \Redirect::to('admin/college/placements/'.request('college_id'))->with('success','Placements Updated!');
    }

    public function collegePlacementDelete($id)
    {   
        $placements = Placement::findOrFail($id);
        $placements->delete();
        return \Redirect::to('admin/college/placements/'.$placements->college_id)->with('success','Placements Deleted!');
    }

    //---------------------------------- College Cut Offs -----------------------------------------

    public function collegeCutOff($id)
    {
        $cut_offs = CutOff::where('college_id', '=', $id)->get();
        return view('admin.college.cut_off.index')->with('id',$id)->with('cut_offs',$cut_offs);
    }

    public function collegeCutOffCreateForm($id)
    {
        return view('admin.college.cut_off.add')->with('id',$id);
    }

    public function collegeCutOffCreate(Request $request)
    {
        $cut_offs = CutOff::storeCutOff($request);
        return \Redirect::to('admin/college/cut_offs/'.request('college_id'))->with('success','Cut Offs Created!');
    }

    public function collegeCutOffEditForm($id)
    {
        $cut_offs = CutOff::find($id);
        return view('admin.college.cut_off.edit')->with('id',$id)->with('cut_offs',$cut_offs);
    }

    public function collegeCutOffEdit(Request $request, $id)
    {   
        $cut_offs = CutOff::editCutOff($request, $id);
        return \Redirect::to('admin/college/cut_offs/'.request('college_id'))->with('success','Cut Offs Updated!');
    }

    public function collegeCutOffDelete($id)
    {   
        $cut_offs = CutOff::findOrFail($id);
        $cut_offs->delete();
        return \Redirect::to('admin/college/cut_offs/'.$cut_offs->college_id)->with('success','Cut Offs Deleted!');
    }

    //---------------------------------- College Infrastructure -----------------------------------------

    public function collegeInfrastructure($id)
    {        
        $infras = Infrastructure::where('college_id', '=', $id)->get();
        return view('admin.college.infrastructure.index')->with('id',$id)->with('infras',$infras);
    }

    public function collegeInfrastructureCreateForm($id)
    {
        return view('admin.college.infrastructure.add')->with('id',$id);
    }

    public function collegeInfrastructureCreate(Request $request)
    {
        $infrastructures = Infrastructure::storeInfrastructure($request);
        return \Redirect::to('admin/college/infrastructures/'.request('id_college'))->with('success','Infrastructure Created!');
    }

    public function collegeInfrastructureEditForm($id)
    {
        $infrastructures = Infrastructure::find($id);
        $infras = Infrastructure::where('college_id', '=', $id)->get();
        return view('admin.college.infrastructure.edit')->with('id',$id)->with('infras',$infras)->with('infrastructures',$infrastructures);
    }

    public function collegeInfrastructureEdit(Request $request, $id)
    {   
        $infrastructures = Infrastructure::editInfrastructure($request, $id);
        return \Redirect::to('admin/college/infrastructures/'.request('id_college'))->with('success','Infrastructure Updated!');
    }

    public function collegeInfrastructureDelete($id)
    {   
        $infrastructures = Infrastructure::findOrFail($id);
        Infrastructure::where('college_id',$id)->delete();
        return \Redirect::to('admin/college/infrastructures/'.$id)->with('success','Infrastructure Deleted!');
    }

    //---------------------------------- College scholarships -----------------------------------------

    public function collegeScholarship($id)
    {
        $scholarships = Scholarship::where('college_id', '=', $id)->get();
        return view('admin.college.scholarship.index')->with('id',$id)->with('scholarships',$scholarships);
    }

    public function collegeScholarshipCreateForm($id)
    {
        return view('admin.college.scholarship.add')->with('id',$id);
    }

    public function collegeScholarshipCreate(Request $request)
    {
        $scholarships = Scholarship::storeScholarship($request);
        return \Redirect::to('admin/college/scholarships/'.request('college_id'))->with('success','Scholarship Created!');
    }

    public function collegeScholarshipEditForm($id)
    {
        $scholarships = Scholarship::find($id);
        return view('admin.college.scholarship.edit')->with('id',$id)->with('scholarships',$scholarships);
    }

    public function collegeScholarshipEdit(Request $request, $id)
    {   
        $scholarships = Scholarship::editScholarship($request, $id);
        return \Redirect::to('admin/college/scholarships/'.request('college_id'))->with('success','Scholarship Updated!');
    }

    public function collegeScholarshipDelete($id)
    {   
        $scholarships = Scholarship::findOrFail($id);
        $scholarships->delete();
        return \Redirect::to('admin/college/scholarships/'.$scholarships->college_id)->with('success','Scholarship Deleted!');
    }
}
