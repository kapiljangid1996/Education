<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['parent_id', 'name', 'slug', 'long_description', 'image',  'meta_name', 'meta_keyword', 'meta_description'];

    public function parent()
    {
    	return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function children()
    {
    	return $this->hasMany('App\Models\Category', 'parent_id')->with('children');
    }

    public static function storeCategory($request)
    {
        $request->validate([
            'name'  => 'required|min:2|max:255|string',
            'slug'  => 'required|min:2|unique:categories,slug',
            'parent_id' => 'sometimes|nullable',
            'long_description'  => 'required|min:3',
            'image'  => 'sometimes|nullable',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_keyword'  => 'required|min:3',
            'meta_description'  => 'required|min:3',
        ]);
        $categories = new Category(); 
        $categories -> name = request('name');
        $categories -> slug = request('slug');
        $categories -> parent_id = request('parent_id');
        $categories -> long_description = request('long_description');
        $categories -> meta_name = request('meta_name');
        $categories -> meta_keyword = request('meta_keyword');
        $categories -> meta_description = request('meta_description');
        if (request()->hasfile('image'))
        {
            $imageName =$request->get('slug')."-".request()->image->getClientOriginalName();
            request()->image->move(public_path('Uploads/Category'), $imageName); 
            $categories->image = $imageName;
        }
        $categories->save();
    }

    public static function editCategory($request,$id)
    {
        $request->validate([
            'name'  => 'required|min:2|max:255|string',
            'slug'  => 'required|min:2',
            'parent_id' => 'sometimes|nullable',
            'long_description'  => 'required|min:3',
            'image'  => 'sometimes|nullable',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_keyword'  => 'required|min:3',
            'meta_description'  => 'required|min:3',
        ]);
        $categories = Category::find($id);
        $categories -> name = $request->input('name');
        $categories -> slug = $request->input('slug');
        $categories -> parent_id = $request->input('parent_id');
        $categories -> long_description = $request->input('long_description');
        $categories -> meta_name = $request->input('meta_name');
        $categories -> meta_description = $request->input('meta_description');
        $categories -> meta_keyword = $request->input('meta_keyword');
        $old_image = $request->input('old_image');
        if ($request->hasfile('image'))
        {
            if(!empty($old_image))
            {
                unlink(public_path("Uploads/Category/{$old_image}"));
            }
            $slug = $request->get('slug');
            $imageName =$slug.'-'.request()->image->getClientOriginalName();
            request()->image->move(public_path('Uploads/Category'), $imageName); 
            $categories->image = $imageName;
        }
        $categories->save();
    }
}
