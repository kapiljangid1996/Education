<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Intervention\Image\ImageManagerStatic as Image;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = ['title', 'logo', 'email1', 'email2', 'contact1', 'contact2', 'address1', 'address2', 'google', 'facebook', 'linkedin', 'twitter', 'footer' , 'meta_name', 'meta_keyword', 'meta_description', 'google_analyst'];

    public static function editSetting($request,$id)
    {
    	$request->validate([
            'title'  => 'required|min:2|max:255|string',
            'logo'  => 'sometimes|nullable',
            'email1' => 'required|sometimes|nullable',
            'contact1'  => 'required|min:3',
            'address1'  => 'required|min:3',
            'footer'  => 'required|min:3',
        ]);
        $setting = Setting::find($id);
        $setting -> title = $request->input('title');
        $setting -> email1 = $request->input('email1');
        $setting -> email2 = $request->input('email2');
        $setting -> contact1 = $request->input('contact1');
        $setting -> contact2 = $request->input('contact2');
        $setting -> address1 = $request->input('address1');
        $setting -> address2 = $request->input('address2');
        $setting -> google = $request->input('google');
        $setting -> facebook = $request->input('facebook');
        $setting -> linkedin = $request->input('linkedin');
        $setting -> twitter = $request->input('twitter');
        $setting -> footer = $request->input('footer');
        $setting -> meta_name = $request->input('meta_name');
        $setting -> meta_description = $request->input('meta_description');
        $setting -> meta_keyword = $request->input('meta_keyword');
        $setting -> google_analyst = $request->input('google_analyst');
        $old_logo = $request->input('old_logo');
        if ($request->hasfile('logo'))
        {
            if(!empty($old_logo))
            {
                unlink(public_path("Uploads/Site/{$old_logo}"));
            }

            if (file_exists( public_path().'Uploads/College/Site/150x100/'.$old_logo)) {
                unlink(public_path("Uploads/College/Site/150x100/{$old_logo}"));
            }
            
            $title = $request->get('title');
            $imageName =$title.'-'.request()->logo->getClientOriginalName();
            request()->logo->move(public_path('Uploads/Site'), $imageName); 
            $setting->logo = $imageName;

            $fullPath = public_path('Uploads/Site/'.$imageName);
            $destinationPath = public_path('Uploads/Site');
            $tiny =  \Tinify\setKey('zKTqyTH753yT0P1FTGYyDQscTG1mQSVF');

            if(!empty($fullPath)){
                $source = \Tinify\fromFile($fullPath);
                $source->toFile($fullPath); 
                Image::make($destinationPath.'/'.$imageName)->resize(150, 100)->save(public_path('Uploads/Site/150x100/'.$imageName)); 
            }
        }
        $setting->save();
    }
}
