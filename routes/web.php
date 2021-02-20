<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ExamsController;
use App\Http\Controllers\Admin\CollegesController;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/courses', [App\Http\Controllers\HomeController::class, 'courseView']);
Route::get('/colleges/{slug}/{slug1}', [App\Http\Controllers\HomeController::class, 'collegeView']);
Route::post('newsletter', [App\Http\Controllers\HomeController::class, 'newsLetter'])->name('newsletter.store');

Route::get('/newsLetter/unsubscribe/{id}', [App\Http\Controllers\HomeController::class, 'newsletterUnsubscribe'])->name('unsubscribe.newsletter');	

//-----------------------------Contact & Inquiry Form on front and export and import on admin--------------------------

Route::get('/contact-us', [App\Http\Controllers\PageController::class, 'contact']);
Route::post('/contact-us', [App\Http\Controllers\PageController::class, 'saveContact'])->name('contact.submit');
Route::get('/registration-form', [App\Http\Controllers\PageController::class, 'studentInquiry']);
Route::post('/registration-form', [App\Http\Controllers\PageController::class, 'saveStudentInquiry'])->name('student.inquiry.submit');
Route::get('/contact/export/{type}', [App\Http\Controllers\PageController::class, 'exportContact'])->name('contact.export');
Route::get('/college/courses/{id}/{type}', [App\Http\Controllers\PageController::class, 'exportCollegeCourse'])->name('college.course.export');
Route::post('/contact/import', [App\Http\Controllers\PageController::class, 'importContact'])->name('contact.import');
Route::post('/college/courses/import', [App\Http\Controllers\PageController::class, 'importCollegeCourse'])->name('college.courses.import');

//-----------------------------Contact & Inquiry Form export on front and and import on admin End ---------------------

//-----------------------------Searching--------------------------

Route::get('/course_name', [App\Http\Controllers\SearchController::class, 'autocompleteCourse'])->name('autocomplete.course'); // Filter College Name
Route::get('/college_name', [App\Http\Controllers\SearchController::class, 'autocompleteCollege'])->name('autocomplete.college'); // Filter Course Name
Route::post('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search'); // Search College and Courses on front page search bar
Route::post('/city_name', [App\Http\Controllers\SearchController::class, 'getCity'])->name('get.city'); // Get City List on college Add and Edit Page

//-----------------------------Searching End--------------------------

//College Reviews
Route::group(['middleware' => 'auth'], function(){
   Route::post('review', [App\Http\Controllers\RatingController::class, 'store'])->name('review.submit');
});

Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']);

Route::get('email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function (){
	//Dashboard
	Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');

	//Login
	Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
	Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');

	//Login
	Route::get('/register', [App\Http\Controllers\Auth\AdminRegisterController::class, 'showRegisterForm'])->name('admin.register');
	Route::post('/register', [App\Http\Controllers\Auth\AdminRegisterController::class, 'register'])->name('admin.register.submit');

	//Logout
	Route::get('/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

	//Menu Builder
	Route::resource('menu', App\Http\Controllers\Admin\MenusController::class);
	Route::get('/menu/manage-menu/{id}', [App\Http\Controllers\Admin\MenusController::class, 'manageMenuPage'])->name('menu_manager.show');
	Route::post('/menu/ajaxGetMenuLinks', [App\Http\Controllers\Admin\MenusController::class, 'ajaxGetMenuLinks']);
	Route::post('/menu/save_menu_links', [App\Http\Controllers\Admin\MenusController::class, 'save_menu_links']);
	Route::post('/menu/ajaxSaveMenuStructure', [App\Http\Controllers\Admin\MenusController::class, 'ajaxSaveMenuStructure']);
	Route::post('/menu/ajaxDeleteMenuPage', [App\Http\Controllers\Admin\MenusController::class, 'ajaxDeleteMenuPage']);
	Route::post('/menu/ajaxMenuPageDetail', [App\Http\Controllers\Admin\MenusController::class, 'ajaxMenuPageDetail']);
	Route::post('/menu/ajaxEditMenuPage', [App\Http\Controllers\Admin\MenusController::class, 'ajaxEditMenuPage']);

	//Category Maker
	Route::resource('slider', App\Http\Controllers\Admin\SlidersController::class);

	//Category Maker
	Route::resource('category', App\Http\Controllers\Admin\CategoriesController::class);

	//Course
	Route::resource('course', App\Http\Controllers\Admin\CoursesController::class);

	//Exam
	Route::resource('exam', App\Http\Controllers\Admin\ExamsController::class);

	//Exam Overviews Routes
	Route::get('/exam/overview/{id}', [ExamsController::class, 'examOverview']);
	Route::get('/exam/overview/add_overview/{id}', [ExamsController::class, 'examOverviewCreateForm']);
	Route::post('/exam/overview/add_overview', [ExamsController::class, 'examOverviewCreate']);
	Route::get('/exam/overview/edit_overview/{id}', [ExamsController::class, 'examOverviewEditForm']);
	Route::post('/exam/overview/edit_overview/{id}', [ExamsController::class, 'examOverviewEdit']);
	Route::get('/exam/overview/delete_overview/{id}', [ExamsController::class, 'examOverviewDelete']);

	//Exam Date Routes
	Route::get('/exam/date/{id}', [ExamsController::class, 'examDate']);
	Route::get('/exam/date/add_date/{id}', [ExamsController::class, 'examDateCreateForm']);
	Route::post('/exam/date/add_date', [ExamsController::class, 'examDateCreate']);
	Route::get('/exam/date/edit_date/{id}', [ExamsController::class, 'examDateEditForm']);
	Route::post('/exam/date/edit_date/{id}', [ExamsController::class, 'examDateEdit']);
	Route::get('/exam/date/delete_date/{id}', [ExamsController::class, 'examDateDelete']);

	//Exam Syllabus Routes
	Route::get('/exam/syllabus/{id}', [ExamsController::class, 'examSyllabus']);
	Route::get('/exam/syllabus/add_syllabus/{id}', [ExamsController::class, 'examSyllabusCreateForm']);
	Route::post('/exam/syllabus/add_syllabus', [ExamsController::class, 'examSyllabusCreate']);
	Route::get('/exam/syllabus/edit_syllabus/{id}', [ExamsController::class, 'examSyllabusEditForm']);
	Route::post('/exam/syllabus/edit_syllabus/{id}', [ExamsController::class, 'examSyllabusEdit']);
	Route::get('/exam/syllabus/delete_syllabus/{id}', [ExamsController::class, 'examSyllabusDelete']);

	//Exam Appform Routes
	Route::get('/exam/appform/{id}', [ExamsController::class, 'examAppform']);
	Route::get('/exam/appform/add_appform/{id}', [ExamsController::class, 'examAppformCreateForm']);
	Route::post('/exam/appform/add_appform', [ExamsController::class, 'examAppformCreate']);
	Route::get('/exam/appform/edit_appform/{id}', [ExamsController::class, 'examAppformEditForm']);
	Route::post('/exam/appform/edit_appform/{id}', [ExamsController::class, 'examAppformEdit']);
	Route::get('/exam/appform/delete_appform/{id}', [ExamsController::class, 'examAppformDelete']);

	//Exam Pattern Routes
	Route::get('/exam/pattern/{id}', [ExamsController::class, 'examPattern']);
	Route::get('/exam/pattern/add_pattern/{id}', [ExamsController::class, 'examPatternCreateForm']);
	Route::post('/exam/pattern/add_pattern', [ExamsController::class, 'examPatternCreate']);
	Route::get('/exam/pattern/edit_pattern/{id}', [ExamsController::class, 'examPatternEditForm']);
	Route::post('/exam/pattern/edit_pattern/{id}', [ExamsController::class, 'examPatternEdit']);
	Route::get('/exam/pattern/delete_pattern/{id}', [ExamsController::class, 'examPatternDelete']);

	//Exam Preparation Routes
	Route::get('/exam/preparation/{id}', [ExamsController::class, 'examPreparation']);
	Route::get('/exam/preparation/add_preparation/{id}', [ExamsController::class, 'examPreparationCreateForm']);
	Route::post('/exam/preparation/add_preparation', [ExamsController::class, 'examPreparationCreate']);
	Route::get('/exam/preparation/edit_preparation/{id}', [ExamsController::class, 'examPreparationEditForm']);
	Route::post('/exam/preparation/edit_preparation/{id}', [ExamsController::class, 'examPreparationEdit']);
	Route::get('/exam/preparation/delete_preparation/{id}', [ExamsController::class, 'examPreparationDelete']);

	//Exam Question Routes
	Route::get('/exam/question/{id}', [ExamsController::class, 'examQuestion']);
	Route::get('/exam/question/add_question/{id}', [ExamsController::class, 'examQuestionCreateForm']);
	Route::post('/exam/question/add_question', [ExamsController::class, 'examQuestionCreate']);
	Route::get('/exam/question/edit_question/{id}', [ExamsController::class, 'examQuestionEditForm']);
	Route::post('/exam/question/edit_question/{id}', [ExamsController::class, 'examQuestionEdit']);
	Route::get('/exam/question/delete_question/{id}', [ExamsController::class, 'examQuestionDelete']);

	//Exam Answer Routes
	Route::get('/exam/answer/{id}', [ExamsController::class, 'examAnswer']);
	Route::get('/exam/answer/add_answer/{id}', [ExamsController::class, 'examAnswerCreateForm']);
	Route::post('/exam/answer/add_answer', [ExamsController::class, 'examAnswerCreate']);
	Route::get('/exam/answer/edit_answer/{id}', [ExamsController::class, 'examAnswerEditForm']);
	Route::post('/exam/answer/edit_answer/{id}', [ExamsController::class, 'examAnswerEdit']);
	Route::get('/exam/answer/delete_answer/{id}', [ExamsController::class, 'examAnswerDelete']);

	//Exam Result Routes
	Route::get('/exam/result/{id}', [ExamsController::class, 'examResult']);
	Route::get('/exam/result/add_result/{id}', [ExamsController::class, 'examResultCreateForm']);
	Route::post('/exam/result/add_result', [ExamsController::class, 'examResultCreate']);
	Route::get('/exam/result/edit_result/{id}', [ExamsController::class, 'examResultEditForm']);
	Route::post('/exam/result/edit_result/{id}', [ExamsController::class, 'examResultEdit']);
	Route::get('/exam/result/delete_result/{id}', [ExamsController::class, 'examResultDelete']);

	//Exam Cutoff Routes
	Route::get('/exam/cutoff/{id}', [ExamsController::class, 'examCutoff']);
	Route::get('/exam/cutoff/add_cutoff/{id}', [ExamsController::class, 'examCutoffCreateForm']);
	Route::post('/exam/cutoff/add_cutoff', [ExamsController::class, 'examCutoffCreate']);
	Route::get('/exam/cutoff/edit_cutoff/{id}', [ExamsController::class, 'examCutoffEditForm']);
	Route::post('/exam/cutoff/edit_cutoff/{id}', [ExamsController::class, 'examCutoffEdit']);
	Route::get('/exam/cutoff/delete_cutoff/{id}', [ExamsController::class, 'examCutoffDelete']);

	//Exam Couselling Routes
	Route::get('/exam/counselling/{id}', [ExamsController::class, 'examCounselling']);
	Route::get('/exam/counselling/add_counselling/{id}', [ExamsController::class, 'examCounsellingCreateForm']);
	Route::post('/exam/counselling/add_counselling', [ExamsController::class, 'examCounsellingCreate']);
	Route::get('/exam/counselling/edit_counselling/{id}', [ExamsController::class, 'examCounsellingEditForm']);
	Route::post('/exam/counselling/edit_counselling/{id}', [ExamsController::class, 'examCounsellingEdit']);
	Route::get('/exam/counselling/delete_counselling/{id}', [ExamsController::class, 'examCounsellingDelete']);

	//College
	Route::resource('college', App\Http\Controllers\Admin\CollegesController::class);	

	//College Course & Fees Routes
	Route::get('/college/course_fees/{id}', [CollegesController::class, 'collegeCourseFee']);
	Route::get('/college/course_fees/add_course_fees/{id}', [CollegesController::class, 'collegeCourseFeeCreateForm']);
	Route::post('/college/course_fees/add_course_fees', [CollegesController::class, 'collegeCourseFeeCreate']);
	Route::get('/college/course_fees/edit_course_fees/{id}', [CollegesController::class, 'collegeCourseFeeEditForm']);
	Route::post('/college/course_fees/edit_course_fees/{id}', [CollegesController::class, 'collegeCourseFeeEdit']);
	Route::get('/college/course_fees/delete_course_fees/{id}', [CollegesController::class, 'collegeCourseFeeDelete']);

	//College Admissions Routes
	Route::get('/college/admissions/{id}', [CollegesController::class, 'collegeAdmission']);
	Route::get('/college/admissions/add_admissions/{id}', [CollegesController::class, 'collegeAdmissionCreateForm']);
	Route::post('/college/admissions/add_admissions', [CollegesController::class, 'collegeAdmissionCreate']);
	Route::get('/college/admissions/edit_admissions/{id}', [CollegesController::class, 'collegeAdmissionEditForm']);
	Route::post('/college/admissions/edit_admissions/{id}', [CollegesController::class, 'collegeAdmissionEdit']);
	Route::get('/college/admissions/delete_admissions/{id}', [CollegesController::class, 'collegeAdmissionDelete']);

	//College Placements Routes
	Route::get('/college/placements/{id}', [CollegesController::class, 'collegePlacement']);
	Route::get('/college/placements/add_placements/{id}', [CollegesController::class, 'collegePlacementCreateForm']);
	Route::post('/college/placements/add_placements', [CollegesController::class, 'collegePlacementCreate']);
	Route::get('/college/placements/edit_placements/{id}', [CollegesController::class, 'collegePlacementEditForm']);
	Route::post('/college/placements/edit_placements/{id}', [CollegesController::class, 'collegePlacementEdit']);
	Route::get('/college/placements/delete_placements/{id}', [CollegesController::class, 'collegePlacementDelete']);	

	//College Cut Offs Routes
	Route::get('/college/cut_offs/{id}', [CollegesController::class, 'collegeCutOff']);
	Route::get('/college/cut_offs/add_cut_offs/{id}', [CollegesController::class, 'collegeCutOffCreateForm']);
	Route::post('/college/cut_offs/add_cut_offs', [CollegesController::class, 'collegeCutOffCreate']);
	Route::get('/college/cut_offs/edit_cut_offs/{id}', [CollegesController::class, 'collegeCutOffEditForm']);
	Route::post('/college/cut_offs/edit_cut_offs/{id}', [CollegesController::class, 'collegeCutOffEdit']);
	Route::get('/college/cut_offs/delete_cut_offs/{id}', [CollegesController::class, 'collegeCutOffDelete']);	

	//College Infrastructure Routes
	Route::get('/college/infrastructures/{id}', [CollegesController::class, 'collegeInfrastructure']);
	Route::get('/college/infrastructures/add_infrastructures/{id}', [CollegesController::class, 'collegeInfrastructureCreateForm']);
	Route::post('/college/infrastructures/add_infrastructures', [CollegesController::class, 'collegeInfrastructureCreate']);
	Route::get('/college/infrastructures/edit_infrastructures/{id}', [CollegesController::class, 'collegeInfrastructureEditForm']);
	Route::post('/college/infrastructures/edit_infrastructures/{id}', [CollegesController::class, 'collegeInfrastructureEdit']);
	Route::get('/college/infrastructures/delete_infrastructures/{id}', [CollegesController::class, 'collegeInfrastructureDelete']);		

	//College Scholarships Routes
	Route::get('/college/scholarships/{id}', [CollegesController::class, 'collegeScholarship']);
	Route::get('/college/scholarships/add_scholarships/{id}', [CollegesController::class, 'collegeScholarshipCreateForm']);
	Route::post('/college/scholarships/add_scholarships', [CollegesController::class, 'collegeScholarshipCreate']);
	Route::get('/college/scholarships/edit_scholarships/{id}', [CollegesController::class, 'collegeScholarshipEditForm']);
	Route::post('/college/scholarships/edit_scholarships/{id}', [CollegesController::class, 'collegeScholarshipEdit']);
	Route::get('/college/scholarships/delete_scholarships/{id}', [CollegesController::class, 'collegeScholarshipDelete']);	

	//Newsletter & Contacts Setting
	Route::get('/contact-list', [App\Http\Controllers\Admin\AdminController::class, 'contactList']);	
	Route::get('/newsLetter-list', [App\Http\Controllers\Admin\AdminController::class, 'newsletterList']);	
	Route::post('/newsLetter-list', [App\Http\Controllers\Admin\AdminController::class, 'newsletterSend'])->name('send.newsletter');	

	//Site Setting
	Route::get('/setting', [App\Http\Controllers\Admin\SettingsController::class, 'index']);	
	Route::post('/setting/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'update']);

	//Page Maker
	Route::resource('page', App\Http\Controllers\Admin\PagesController::class);
});

Route::get('/course/{slug}', [App\Http\Controllers\HomeController::class, 'courseDetail']);
Route::get('/college/{slug}', [App\Http\Controllers\HomeController::class, 'collegeDetail']);
