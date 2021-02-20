<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Contact;
use App\Models\City;
use App\Models\College\CourseFee;
use App\Exports\ContactsExport;
use App\Imports\ContactsImport;
use App\Exports\CollegeCoursesExport;
use App\Imports\CollegeCoursesImport;

class PageController extends Controller
{
	public function contact()
	{
		$city_list = City::all();
		return view('front.contact')->with('city_list', $city_list);
	}

	public function saveContact(Request $request)
	{
		$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'email'  => 'required|email|unique:contacts,email',
            'contact'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:9,13',
            'city' => 'required',
            'tenth_percent' => 'required',
            'twelfth_percent' => 'required',
            'graduation_percent' => 'required',
            'g-recaptcha-response' => 'required',
        ]);
		$contacts = Contact::create($request->all());
		return redirect()->back()->with('toast_success','Thank You!');
	}

	public function studentInquiry()
	{
		$city_list = City::all();
		return view('front.inquiry')->with('city_list', $city_list);
	}

	public function saveStudentInquiry(Request $request)
	{
		$inquiry = Contact::storeInquiry($request);
		return redirect()->back()->with('toast_success','Thank You!');
	}

	public function exportContact($type)
	{
		return Excel::download(new ContactsExport, 'student-list.' . $type); //Export Contact List
	}

	public function importContact(Request $request)
	{
		$data = Excel::toArray(new ContactsImport, request()->file('file')); //Update Contact List when importing data

		foreach ($data as $key => $value) {
			foreach ($value as $key => $val) {

				$contacts = Contact::find($val['id']);
				$contacts -> name = $val['name'];
				$contacts -> email = $val['email'];
				$contacts -> contact = $val['contact'];
				$contacts -> city = $val['city'];
				$contacts -> tenth_percent = $val['tenth_percent'];
				$contacts -> twelfth_percent = $val['twelfth_percent'];
				$contacts -> graduation_Percent = $val['graduation_percent'];
				$contacts -> reg_id = $val['reg_id'];
				$contacts->save();

			}
		}

		/*collect(head($data))->each(function ($row, $key) {
            Contact::where('id', $row['id'])->update(Arr::except($row, ['id']));
        });*/
        return redirect()->back()->with('toast_success','Data Updated!');
	}

	public function exportCollegeCourse($id, $type)
	{
		return Excel::download(new CollegeCoursesExport($id), 'course.' . $type); //Export College Courses List
	}

	public function importCollegeCourse(Request $request)
	{
		$data = Excel::toArray(new CollegeCoursesImport, request()->file('file'));  //Update College Courses List when importing data
		collect(head($data))->each(function ($row, $key) {
            CourseFee::where('id', $row['id'])->update(Arr::except($row, ['id']));
        });
        return redirect()->back()->with('toast_success','Data Updated!');
	}

}
