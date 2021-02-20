<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::with('children')->get();
    	return view('admin.category.index')->with('categories',$categories);
    }

    public function store(Request $request)
    {
    	$categories = Category::storeCategory($request);
   		return redirect()->route('category.index')->with('success','Category Created!');
    }

    public function edit($id)
    {
        $categories = Category::with('children')->find($id);
        $catgs = Category::whereNull('parent_id')->get();
        return view('admin.category.edit')->with('categories',$categories)->with('catgs',$catgs);
    }

    public function update(Request $request, $id)
    {
    	$categories = Category::editCategory($request,$id);
    	return redirect()->route('category.index')->with('success','Category Updated!');
    }

    public function destroy(Category $category)
    {
    	if ($category->children) 
    	{
       		$category->children()->delete();
    	}
    	$category->delete();
    	return redirect()->route('category.index')->with('success','Category Deleted!');
    }

    public function export($type)
    {
        return Excel::download(new CategoryExport, 'categories.' . $type);
    }
}
