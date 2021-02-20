<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$setting = Setting::get();
        return view('admin.setting')->with('setting',$setting);
    }

    public function update(Request $request, $id)
    {   
        $setting = Setting::editSetting($request,$id);
        return \Redirect::to('admin/setting')->with('success', 'Setting Updated Successfully.');
    }
}
