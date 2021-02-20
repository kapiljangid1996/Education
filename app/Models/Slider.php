<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Intervention\Image\ImageManagerStatic as Image;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    protected $fillable = ['title', 'slug', 'long_description', 'image', 'button_text', 'button_url', 'status'];

    public static function storeSlider($request)
    {
    	$request->validate([
            'title'  => 'required|min:2|max:255|string',
            'slug'  => 'required|min:2|max:255|string',
            'long_description'  => 'sometimes|nullable',
            'image'  => 'sometimes|nullable',
            'button_text'  => 'sometimes|nullable|string',
            'button_url'  => 'sometimes|nullable',
        ]);
        $sliders = new Slider(); 
        $sliders -> title = request('title');
        $sliders -> slug = request('slug');
        $sliders -> long_description = request('long_description');
        $sliders -> button_text = request('button_text');
        $sliders -> button_url = request('button_url');
        $sliders -> status = request('status');
        if (request()->hasfile('image'))
        {
            $imageName =$request->get('slug')."-".request()->image->getClientOriginalName();
            request()->image->move(public_path('Uploads/Slider'), $imageName); 
            $sliders->image = $imageName;

            $fullPath = public_path('Uploads/Slider/'.$imageName);
            $destinationPath = public_path('Uploads/Slider');
            $tiny =  \Tinify\setKey('zKTqyTH753yT0P1FTGYyDQscTG1mQSVF');

            if(!empty($fullPath)){
                $source = \Tinify\fromFile($fullPath);
                $source->toFile($fullPath); 
                Image::make($destinationPath.'/'.$imageName)->resize(1920, 570)->save(public_path('Uploads/Slider/1920x570/'.$imageName)); 
            }
        }
        $sliders->save();
    }

    public static function editSlider($request,$id)
    {
    	$request->validate([
            'title'  => 'required|min:2|max:255|string',
            'slug'  => 'required|min:2|max:255|string',
            'long_description'  => 'sometimes|nullable',
            'image'  => 'sometimes|nullable',
            'button_text'  => 'sometimes|nullable|string',
            'button_url'  => 'sometimes|nullable|min:3',
        ]);
        $sliders = Slider::find($id);
        $sliders -> title = $request->input('title');
        $sliders -> slug = $request->input('slug');
        $sliders -> long_description = $request->input('long_description');
        $sliders -> button_text = $request->input('button_text');
        $sliders -> button_url = $request->input('button_url');
        $sliders -> status = $request->input('status');
        $old_image = $request->input('old_image');
        if ($request->hasfile('image'))
        {
            if(!empty($old_image))
            {
                unlink(public_path("Uploads/Slider/{$old_image}"));
            }

            if (file_exists( public_path("Uploads/Slider/1920x570/{$old_image}"))) {
                unlink(public_path("Uploads/Slider/1920x570/{$old_image}"));
            }

            $slug = $request->get('slug');
            $imageName =$slug.'-'.request()->image->getClientOriginalName();
            request()->image->move(public_path('Uploads/Slider'), $imageName); 
            $sliders->image = $imageName;

            $fullPath = public_path('Uploads/Slider/'.$imageName);
            $destinationPath = public_path('Uploads/Slider');
            $tiny =  \Tinify\setKey('zKTqyTH753yT0P1FTGYyDQscTG1mQSVF');

            if(!empty($fullPath)){
                $source = \Tinify\fromFile($fullPath);
                $source->toFile($fullPath); 
                Image::make($destinationPath.'/'.$imageName)->resize(1920, 570)->save(public_path('Uploads/Slider/1920x570/'.$imageName)); 
            }
        }
        $sliders->save();
    }
}