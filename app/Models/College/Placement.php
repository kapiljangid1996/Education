<?php

namespace App\Models\College;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    use HasFactory;

    protected $table = 'college_placements';

    protected $fillable = ['heading','slug','college_id','long_description','meta_name','meta_description','meta_keyword','sort_order','status'];

    public static function storePlacement($request)
    {
    	$request->validate([
            'heading'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3|unique:college_placements,slug',
            'long_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
    	$placements = new Placement(); 
        $placements -> heading = request('heading');
        $placements -> slug = request('slug');
        $placements -> long_description = request('long_description');
        $placements -> meta_name = request('meta_name');
        $placements -> meta_description = request('meta_description');
        $placements -> meta_keyword = request('meta_keyword');
        $placements -> college_id = request('college_id');
        $placements -> status = request('status');
        $placements->save(); 
    }

    public static function editPlacement($request,$id)
    {
        $request->validate([
            'heading'  => 'required|min:3|max:255|string',
            'slug'  => 'required|min:3',
            'long_description'  => 'required|min:3',
            'meta_name'  => 'required|min:3|max:255|string',
            'meta_description'  => 'required|min:3',
            'meta_keyword'  => 'required|min:3',
            'status' => 'boolean',
        ]);
        $placements =  Placement::find($id);
        $placements -> heading = request('heading');
        $placements -> slug = request('slug');
        $placements -> long_description = request('long_description');
        $placements -> meta_name = request('meta_name');
        $placements -> meta_description = request('meta_description');
        $placements -> meta_keyword = request('meta_keyword');
        $placements -> college_id = request('college_id');
        $placements -> status = request('status');
        $placements->save(); 
    }
}
