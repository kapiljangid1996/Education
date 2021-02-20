<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Exam\Exam;
use App\Models\Exam\ExamOverview;
use App\Models\Exam\ExamDate;
use App\Models\Exam\ExamSyllabus;
use App\Models\Exam\ExamAppform;
use App\Models\Exam\ExamPattern;
use App\Models\Exam\ExamPreparation;
use App\Models\Exam\ExamQuestion;
use App\Models\Exam\ExamAnswer;
use App\Models\Exam\ExamResult;
use App\Models\Exam\ExamCutOff;
use App\Models\Exam\ExamCounselling;

class ExamsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$exams = Exam::with('category')->get();
        return view('admin.exam.index')->with('exams',$exams);
    }

    public function create()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.exam.add')->with('categories',$categories);
    }

    public function store(Request $request)
    {
        $Exam = Exam::storeExam($request);
        return redirect()->route('exam.index')->with('success','Exam Created!');
    }

    public function edit($id)
    {
        $exams = Exam::with('category')->find($id);
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.exam.edit')->with('categories',$categories)->with('exams',$exams);
    }

    public function update(Request $request, $id)
    {   
        $Exam = Exam::editExam($request,$id);
        return redirect()->route('exam.index')->with('success','Exam Updated!');
    }

    public function destroy($id)
    {
        $Exam = Exam::findOrFail($id);
        $Exam->delete();
        return redirect()->route('exam.index')->with('success','Exam Deleted!');
    }

    //---------------------------------- Exam Overviews -----------------------------------------

    public function examOverview($id)
    {
        $overviews = ExamOverview::where('exams_id', '=', $id)->get();
        return view('admin.exam.overview.index')->with('id',$id)->with('overviews',$overviews);
    }

    public function examOverviewCreateForm($id)
    {
        return view('admin.exam.overview.add')->with('id',$id);
    }

    public function examOverviewCreate(Request $request)
    {
        $overviews = ExamOverview::storeOverview($request);
        return \Redirect::to('admin/exam/overview/'.request('exams_id'))->with('success','Overviews Created!');
    }

    public function examOverviewEditForm($id)
    {
        $overviews = ExamOverview::find($id);
        return view('admin.exam.overview.edit')->with('id',$id)->with('overviews',$overviews);
    }

    public function examOverviewEdit(Request $request, $id)
    {   
        $overviews = ExamOverview::editOverview($request, $id);
        return \Redirect::to('admin/exam/overview/'.request('exams_id'))->with('success','Overview Updated!');
    }

    public function examOverviewDelete($id)
    {   
        $overviews = ExamOverview::findOrFail($id);
        $overviews->delete();
        return \Redirect::to('admin/exam/overview/'.$overviews->exams_id)->with('success','Overview Deleted!');
    }

    //---------------------------------- Exam Dates -----------------------------------------

    public function examDate($id)
    {
        $dates = ExamDate::where('exams_id', '=', $id)->get();
        return view('admin.exam.date.index')->with('id',$id)->with('dates',$dates);
    }

    public function examDateCreateForm($id)
    {
        return view('admin.exam.date.add')->with('id',$id);
    }

    public function examDateCreate(Request $request)
    {
        $dates = ExamDate::storeDate($request);
        return \Redirect::to('admin/exam/date/'.request('exams_id'))->with('success','Date Created!');
    }

    public function examDateEditForm($id)
    {
        $dates = ExamDate::find($id);
        return view('admin.exam.date.edit')->with('id',$id)->with('dates',$dates);
    }

    public function examDateEdit(Request $request, $id)
    {   
        $dates = ExamDate::editDate($request, $id);
        return \Redirect::to('admin/exam/date/'.request('exams_id'))->with('success','Date Updated!');
    }

    public function examDateDelete($id)
    {   
        $dates = ExamDate::findOrFail($id);
        $dates->delete();
        return \Redirect::to('admin/exam/date/'.$dates->exams_id)->with('success','Date Deleted!');
    }

    //------------------------------- Exam Syllabus --------------------------------------------------------

    public function examSyllabus($id)
    {
        $syllabi = ExamSyllabus::where('exams_id', '=', $id)->get();
        return view('admin.exam.syllabus.index')->with('id',$id)->with('syllabi',$syllabi);
    }

    public function examSyllabusCreateForm($id)
    {
        return view('admin.exam.syllabus.add')->with('id',$id);
    }

    public function examSyllabusCreate(Request $request)
    {
        $syllabi = ExamSyllabus::storeSyllabus($request);
        return \Redirect::to('admin/exam/syllabus/'.request('exams_id'))->with('success','Syllabus Created!');
    }

    public function examSyllabusEditForm($id)
    {
        $syllabi = ExamSyllabus::find($id);
        return view('admin.exam.syllabus.edit')->with('id',$id)->with('syllabi',$syllabi);
    }

    public function examSyllabusEdit(Request $request, $id)
    {   
        $syllabi = ExamSyllabus::editSyllabus($request, $id);
        return \Redirect::to('admin/exam/syllabus/'.request('exams_id'))->with('success','Syllabus Updated!');
    }

    public function examSyllabusDelete($id)
    {   
        $syllabi = ExamSyllabus::findOrFail($id);
        $syllabi->delete();
        return \Redirect::to('admin/exam/syllabus/'.$syllabi->exams_id)->with('success','Syllabus Deleted!');
    }

    //------------------------------- Exam Application Form --------------------------------------------------------

    public function examAppform($id)
    {
        $appforms = ExamAppform::where('exams_id', '=', $id)->get();
        return view('admin.exam.appform.index')->with('id',$id)->with('appforms',$appforms);
    }

    public function examAppformCreateForm($id)
    {
        return view('admin.exam.appform.add')->with('id',$id);
    }

    public function examAppformCreate(Request $request)
    {
        $appforms = ExamAppform::storeAppform($request);
        return \Redirect::to('admin/exam/appform/'.request('exams_id'))->with('success','Form Content Created!');
    }

    public function examAppformEditForm($id)
    {
        $appforms = ExamAppform::find($id);
        return view('admin.exam.appform.edit')->with('id',$id)->with('appforms',$appforms);
    }

    public function examAppformEdit(Request $request, $id)
    {   
        $appforms = ExamAppform::editAppform($request, $id);
        return \Redirect::to('admin/exam/appform/'.request('exams_id'))->with('success','Form Content Updated!');
    }

    public function examAppformDelete($id)
    {   
        $appforms = ExamAppform::findOrFail($id);
        $appforms->delete();
        return \Redirect::to('admin/exam/appform/'.$appforms->exams_id)->with('success','Form Content Deleted!');
    }

    //------------------------------- Exam Pattern --------------------------------------------------------

    public function examPattern($id)
    {
        $patterns = ExamPattern::where('exams_id', '=', $id)->get();
        return view('admin.exam.pattern.index')->with('id',$id)->with('patterns',$patterns);
    }

    public function examPatternCreateForm($id)
    {
        return view('admin.exam.pattern.add')->with('id',$id);
    }

    public function examPatternCreate(Request $request)
    {
        $patterns = ExamPattern::storePattern($request);
        return \Redirect::to('admin/exam/pattern/'.request('exams_id'))->with('success','Pattern Created!');
    }

    public function examPatternEditForm($id)
    {
        $patterns = ExamPattern::find($id);
        return view('admin.exam.pattern.edit')->with('id',$id)->with('patterns',$patterns);
    }

    public function examPatternEdit(Request $request, $id)
    {   
        $patterns = ExamPattern::editPattern($request, $id);
        return \Redirect::to('admin/exam/pattern/'.request('exams_id'))->with('success','Pattern Updated!');
    }

    public function examPatternDelete($id)
    {   
        $patterns = ExamPattern::findOrFail($id);
        $patterns->delete();
        return \Redirect::to('admin/exam/pattern/'.$patterns->exams_id)->with('success','Pattern Deleted!');
    }

    //------------------------------- Exam Preparation --------------------------------------------------------

    public function examPreparation($id)
    {
        $preparations = ExamPreparation::where('exams_id', '=', $id)->get();
        return view('admin.exam.preparation.index')->with('id',$id)->with('preparations',$preparations);
    }

    public function examPreparationCreateForm($id)
    {
        return view('admin.exam.preparation.add')->with('id',$id);
    }

    public function examPreparationCreate(Request $request)
    {
        $preparations = ExamPreparation::storePreparation($request);
        return \Redirect::to('admin/exam/preparation/'.request('exams_id'))->with('success','Preparation Created!');
    }

    public function examPreparationEditForm($id)
    {
        $preparations = ExamPreparation::find($id);
        return view('admin.exam.preparation.edit')->with('id',$id)->with('preparations',$preparations);
    }

    public function examPreparationEdit(Request $request, $id)
    {   
        $preparations = ExamPreparation::editPreparation($request, $id);
        return \Redirect::to('admin/exam/preparation/'.request('exams_id'))->with('success','Preparation Updated!');
    }

    public function examPreparationDelete($id)
    {   
        $preparations = ExamPreparation::findOrFail($id);
        $preparations->delete();
        return \Redirect::to('admin/exam/preparation/'.$preparations->exams_id)->with('success','Preparation Deleted!');
    }

    //------------------------------- Exam Question --------------------------------------------------------

    public function examQuestion($id)
    {
        $questions = ExamQuestion::where('exams_id', '=', $id)->get();
        return view('admin.exam.question.index')->with('id',$id)->with('questions',$questions);
    }

    public function examQuestionCreateForm($id)
    {
        return view('admin.exam.question.add')->with('id',$id);
    }

    public function examQuestionCreate(Request $request)
    {
        $questions = ExamQuestion::storeQuestion($request);
        return \Redirect::to('admin/exam/question/'.request('exams_id'))->with('success','Question Created!');
    }

    public function examQuestionEditForm($id)
    {
        $questions = ExamQuestion::find($id);
        return view('admin.exam.question.edit')->with('id',$id)->with('questions',$questions);
    }

    public function examQuestionEdit(Request $request, $id)
    {   
        $questions = ExamQuestion::editQuestion($request, $id);
        return \Redirect::to('admin/exam/question/'.request('exams_id'))->with('success','Question Updated!');
    }

    public function examQuestionDelete($id)
    {   
        $questions = ExamQuestion::findOrFail($id);
        $questions->delete();
        return \Redirect::to('admin/exam/question/'.$questions->exams_id)->with('success','Question Deleted!');
    }

    //------------------------------- Exam Answer ----------------------------------------------------------

    public function examAnswer($id)
    {
        $answers = ExamAnswer::where('exams_id', '=', $id)->get();
        return view('admin.exam.answer.index')->with('id',$id)->with('answers',$answers);
    }

    public function examAnswerCreateForm($id)
    {
        return view('admin.exam.answer.add')->with('id',$id);
    }

    public function examAnswerCreate(Request $request)
    {
        $answers = ExamAnswer::storeAnswer($request);
        return \Redirect::to('admin/exam/answer/'.request('exams_id'))->with('success','Answer Created!');
    }

    public function examAnswerEditForm($id)
    {
        $answers = ExamAnswer::find($id);
        return view('admin.exam.answer.edit')->with('id',$id)->with('answers',$answers);
    }

    public function examAnswerEdit(Request $request, $id)
    {   
        $answers = ExamAnswer::editAnswer($request, $id);
        return \Redirect::to('admin/exam/answer/'.request('exams_id'))->with('success','Answer Updated!');
    }

    public function examAnswerDelete($id)
    {   
        $answers = ExamAnswer::findOrFail($id);
        $answers->delete();
        return \Redirect::to('admin/exam/answer/'.$answers->exams_id)->with('success','Answer Deleted!');
    }

    //------------------------------- Exam Result ----------------------------------------------------------

    public function examResult($id)
    {
        $results = ExamResult::where('exams_id', '=', $id)->get();
        return view('admin.exam.result.index')->with('id',$id)->with('results',$results);
    }

    public function examResultCreateForm($id)
    {
        return view('admin.exam.result.add')->with('id',$id);
    }

    public function examResultCreate(Request $request)
    {
        $results = ExamResult::storeResult($request);
        return \Redirect::to('admin/exam/result/'.request('exams_id'))->with('success','Result Created!');
    }

    public function examResultEditForm($id)
    {
        $results = ExamResult::find($id);
        return view('admin.exam.result.edit')->with('id',$id)->with('results',$results);
    }

    public function examResultEdit(Request $request, $id)
    {   
        $results = ExamResult::editResult($request, $id);
        return \Redirect::to('admin/exam/result/'.request('exams_id'))->with('success','Result Updated!');
    }

    public function examResultDelete($id)
    {   
        $results = ExamResult::findOrFail($id);
        $results->delete();
        return \Redirect::to('admin/exam/result/'.$results->exams_id)->with('success','Result Deleted!');
    }

    //------------------------------- Exam Cut Off ----------------------------------------------------------

    public function examCutoff($id)
    {
        $cutoffs = ExamCutOff::where('exams_id', '=', $id)->get();
        return view('admin.exam.cutoff.index')->with('id',$id)->with('cutoffs',$cutoffs);
    }

    public function examCutoffCreateForm($id)
    {
        return view('admin.exam.cutoff.add')->with('id',$id);
    }

    public function examCutoffCreate(Request $request)
    {
        $cutoffs = ExamCutOff::storeCutoff($request);
        return \Redirect::to('admin/exam/cutoff/'.request('exams_id'))->with('success','Cut Off Created!');
    }

    public function examCutoffEditForm($id)
    {
        $cutoffs = ExamCutOff::find($id);
        return view('admin.exam.cutoff.edit')->with('id',$id)->with('cutoffs',$cutoffs);
    }

    public function examCutoffEdit(Request $request, $id)
    {   
        $cutoffs = ExamCutOff::editCutoff($request, $id);
        return \Redirect::to('admin/exam/cutoff/'.request('exams_id'))->with('success','Cut Off Updated!');
    }

    public function examCutoffDelete($id)
    {   
        $cutoffs = ExamCutOff::findOrFail($id);
        $cutoffs->delete();
        return \Redirect::to('admin/exam/cutoff/'.$cutoffs->exams_id)->with('success','Cut Off Deleted!');
    }

    //------------------------------- Exam Counselling ----------------------------------------------------------

    public function examCounselling($id)
    {
        $counsellings = ExamCounselling::where('exams_id', '=', $id)->get();
        return view('admin.exam.counselling.index')->with('id',$id)->with('counsellings',$counsellings);
    }

    public function examCounsellingCreateForm($id)
    {
        return view('admin.exam.counselling.add')->with('id',$id);
    }

    public function examCounsellingCreate(Request $request)
    {
        $counsellings = ExamCounselling::storeCounselling($request);
        return \Redirect::to('admin/exam/counselling/'.request('exams_id'))->with('success','Counselling Created!');
    }

    public function examCounsellingEditForm($id)
    {
        $counsellings = ExamCounselling::find($id);
        return view('admin.exam.counselling.edit')->with('id',$id)->with('counsellings',$counsellings);
    }

    public function examCounsellingEdit(Request $request, $id)
    {   
        $counsellings = ExamCounselling::editCounselling($request, $id);
        return \Redirect::to('admin/exam/counselling/'.request('exams_id'))->with('success','Counselling Updated!');
    }

    public function examCounsellingDelete($id)
    {   
        $counsellings = ExamCounselling::findOrFail($id);
        $counsellings->delete();
        return \Redirect::to('admin/exam/counselling/'.$counsellings->exams_id)->with('success','Counselling Deleted!');
    }
}
