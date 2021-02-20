<?php 

namespace App\Models\College;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Intervention\Image\ImageManagerStatic as Image;

class College extends Model
{
    use HasFactory;

    protected $table = 'colleges';

    protected $fillable = ['name','slug','ownership','state','city','street','post_code','contact1','contact2','email1','email2','website','long_description','short_description','image','logo','avg_rating','meta_name','meta_description','meta_keyword','status','featured_colleges','sort_order'];

    public function state_name()
    {
        return $this->belongsTo('App\Models\State', 'state', 'id');
    }

    public function city_name()
    {
        return $this->belongsTo('App\Models\City', 'city', 'id');
    }

    public function admission()
    {
        return $this->hasMany('App\Models\College\Admission')->where('status',1);
    }

    public function placement()
    {
        return $this->hasMany('App\Models\College\Placement')->where('status',1);
    }

    public function infrastructure()
    {
        return $this->hasMany('App\Models\College\Infrastructure');
    }

    public function course_fee()
    {
        return $this->hasMany('App\Models\College\CourseFee')->where('status',1);
    }

    public function cut_off()
    {
        return $this->hasMany('App\Models\College\CutOff')->where('status',1);
    }

    public function course_exams()
    {
        return $this->hasMany('App\Models\College\Coursefee_Exam');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function category_list()
    {
        return $this->hasMany('App\Models\College\College_Category');
    }

    public static function storeCollege($request)
    {
        //echo '<pre>';print_r($request->all());die;
    	$request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|unique:colleges,slug',
            'ownership' => 'required|sometimes|nullable',
            'state'  => 'required|sometimes|nullable',
            'city'  => 'required|sometimes|nullable',
            'street'  => 'required|min:3',
            'post_code'  => 'required|numeric',
            'contact1'  => 'required',
            'email1'  => 'email|string',
            'website'  => 'string',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'image'  => 'required',
            'logo'  => 'required',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
        $colleges = new College(); 
        $colleges -> name = request('name');
        $colleges -> slug = request('slug');
        $colleges -> ownership = request('ownership');
        $colleges -> state = request('state');
        $colleges -> city = request('city');
        $colleges -> street = request('street');
        $colleges -> post_code = request('post_code');
        $colleges -> contact1 = request('contact1');
        $colleges -> contact2 = request('contact2');
        $colleges -> email1 = request('email1');
        $colleges -> email2 = request('email2');
        $colleges -> website = request('website');
        $colleges -> long_description = request('long_description');
        $colleges -> short_description = request('short_description');
        $colleges -> avg_rating = request('avg_rating');
        $colleges -> academic_rating = request('academic_rating');
        $colleges -> fee_rating = request('fee_rating');
        $colleges -> placement_rating = request('placement_rating');
        $colleges -> infrastructure_rating = request('infrastructure_rating');
        $colleges -> meta_name = request('meta_name');
        $colleges -> meta_description = request('meta_description');
        $colleges -> meta_keyword = request('meta_keyword');
        $colleges -> status = request('status');
        $colleges -> featured_colleges = (isset($request['featured_colleges']))?1:0;

        if (request()->hasfile('image'))
        {
            $imageName =$request->get('slug')."-".request()->image->getClientOriginalName();
            request()->image->move(public_path('Uploads/College/Image'), $imageName); 
            $colleges->image = $imageName;

            $fullPath = public_path('Uploads/College/Image/'.$imageName);
            $destinationPath = public_path('Uploads/College/Image');
            $tiny =  \Tinify\setKey('zKTqyTH753yT0P1FTGYyDQscTG1mQSVF');

            if(!empty($fullPath)){
                $source = \Tinify\fromFile($fullPath);
                $source->toFile($fullPath); 
                Image::make($destinationPath.'/'.$imageName)->resize(400, 200)->save(public_path('Uploads/College/Image/400x200/'.$imageName)); 
            }
        }

        if (request()->hasfile('logo'))
        {
            $logoName =$request->get('slug')."-".request()->logo->getClientOriginalName();
            request()->logo->move(public_path('Uploads/College/Logo'), $logoName); 
            $colleges->logo = $logoName;

            $fullPath = public_path('Uploads/College/Logo/'.$logoName);
            $destinationPath = public_path('Uploads/College/Logo');
            $tiny =  \Tinify\setKey('zKTqyTH753yT0P1FTGYyDQscTG1mQSVF');

            if(!empty($fullPath)){
                $source = \Tinify\fromFile($fullPath);
                $source->toFile($fullPath); 
                Image::make($destinationPath.'/'.$logoName)->resize(55, 55)->save(public_path('Uploads/College/Logo/55x55/'.$logoName)); 
            }
        }

        $colleges->save();                

        $lastInsertedId= $colleges->id;

        if (!empty($category_id=$request->input('category_id'))){
            foreach($category_id as $id_category){
                $college_categories = new College_Category();
                $college_categories -> category_id = $id_category; 
                $college_categories -> college_id = $lastInsertedId; 
                $college_categories->save(); 
            }
        }
    }

    public static function editCollege($request,$id)
    {
        $request->validate([
            'name'  => 'required|min:3|max:255|string',
            'slug'  => 'required|unique:colleges,slug,'.$id,
            'ownership' => 'required|sometimes|nullable',
            'state'  => 'required|sometimes|nullable',
            'city'  => 'required|sometimes|nullable',
            'street'  => 'required|min:3',
            'post_code'  => 'required|numeric',
            'contact1'  => 'required',
            'email1'  => 'required|email|string',
            'website'  => 'required|string',
            'long_description'  => 'required|min:3',
            'short_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
        $colleges = College::find($id);
        $colleges -> name = $request->input('name');
        $colleges -> slug = $request->input('slug');
        $colleges -> ownership = $request->input('ownership');
        $colleges -> state = $request->input('state');
        $colleges -> city = $request->input('city');
        $colleges -> street = $request->input('street');
        $colleges -> post_code = $request->input('post_code');
        $colleges -> contact1 = $request->input('contact1');
        $colleges -> contact2 = $request->input('contact2');
        $colleges -> email1 = $request->input('email1');
        $colleges -> email2 = $request->input('email2');
        $colleges -> website = $request->input('website');
        $colleges -> long_description = $request->input('long_description');
        $colleges -> short_description = $request->input('short_description');
        $colleges -> avg_rating = $request->input('avg_rating');
        $colleges -> academic_rating = $request->input('academic_rating');
        $colleges -> fee_rating = $request->input('fee_rating');
        $colleges -> placement_rating = $request->input('placement_rating');
        $colleges -> infrastructure_rating = $request->input('infrastructure_rating');
        $colleges -> meta_name = $request->input('meta_name');
        $colleges -> meta_description = $request->input('meta_description');
        $colleges -> meta_keyword = $request->input('meta_keyword');
        $colleges -> status = $request->input('status');
        $colleges -> featured_colleges = (isset($request['featured_colleges']))?1:0;
        $old_image = $request->input('old_image');
        $old_logo = $request->input('old_logo');

        if ($request->hasfile('image'))
        {
            if (file_exists( public_path().'Uploads/College/Image/'.$old_image))
            {
                unlink(public_path("Uploads/College/Image/{$old_image}"));                
            }

            if (file_exists( public_path().'Uploads/College/Image/400x200/'.$old_image)) {
                unlink(public_path("Uploads/College/Image/400x200/{$old_image}"));
            }

            $slug = $request->get('slug');
            $imageName =$slug.'-'.request()->image->getClientOriginalName();
            request()->image->move(public_path('Uploads/College/Image'), $imageName); 
            $colleges->image = $imageName;            

            $fullPath = public_path('Uploads/College/Image/'.$imageName);
            $destinationPath = public_path('Uploads/College/Image');
            $tiny =  \Tinify\setKey('zKTqyTH753yT0P1FTGYyDQscTG1mQSVF');

            if(!empty($fullPath)){
                $source = \Tinify\fromFile($fullPath);
                $source->toFile($fullPath); 
                Image::make($destinationPath.'/'.$imageName)->resize(400, 200)->save(public_path('Uploads/College/Image/400x200/'.$imageName)); 
            }
        }

        if ($request->hasfile('logo'))
        {

            if (file_exists( public_path().'Uploads/College/Logo/'.$old_logo))
            {
                unlink(public_path("Uploads/College/Logo/{$old_logo}"));                
            }

            if (file_exists( public_path().'Uploads/College/Logo/55x55/'.$old_logo)) {
                unlink(public_path("Uploads/College/Logo/55x55/{$old_logo}"));
            }

            $slug = $request->get('slug');
            $logoName =$slug."-".request()->logo->getClientOriginalName();
            request()->logo->move(public_path('Uploads/College/Logo'), $logoName); 
            $colleges->logo = $logoName;

            $fullPath = public_path('Uploads/College/Logo/'.$logoName);
            $destinationPath = public_path('Uploads/College/Logo');
            $tiny =  \Tinify\setKey('zKTqyTH753yT0P1FTGYyDQscTG1mQSVF');

            if(!empty($fullPath)){
                $source = \Tinify\fromFile($fullPath);
                $source->toFile($fullPath); 
                Image::make($destinationPath.'/'.$logoName)->resize(55, 55)->save(public_path('Uploads/College/Logo/55x55/'.$logoName)); 
            }
        }

        $colleges->save();

        $id_college = $request->input('id_college');

        College_Category::where('college_id',$id_college)->delete();

        if (!empty($category_id=$request->input('category_id'))){
            foreach($category_id as $id_category){
                $college_categories = new College_Category();
                $college_categories -> category_id = $id_category; 
                $college_categories -> college_id = $request->input('id_college'); 
                $college_categories->save(); 
            }
        }
    }    
}
