<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College\College;
use App\Models\Course\Course;
use App\Models\Rating;
use App\Models\City;
use App\Models\Filter;

class SearchController extends Controller
{
    /*----------------------------------------------Get City According to the State on College add & edit page admin -----------------------------*/
    public function getCity(Request $request)
    {
        $result = $request->get('state_id');
        $get_city = $request->get('city_id');

        $query = City::where('state_id',$result)->get();

        echo '<option value="">Select city</option>';
        
        foreach ($query as $key => $value) {
            if ($get_city == $value->id) {
               echo '<option value="'.$value->id.'" selected="selected">'.$value->name.'</option>';
            }
            else{
                echo '<option value="'.$value->id.'">'.$value->name.'</option>';
            }
        }  
        die();      
    }
    /*---------------------------------------------------------------------------------------------------------------------------------------------*/

    /*-----------------------------------------------------------Search College and Courses on Home Page-------------------------------------------*/
    public function search(Request $request)
    {
        if(!empty($request->get('query'))){
            $query = $request->get('query');
            $result = $request->get('type');
            if ($result == 'college') {
                $data = College::with('city_name')->orderBy('name','asc')->where('name', 'like', '%'.$query.'%')->orWhere('city', 'like', '%'.$query.'%')->orWhere('state', 'like', '%'.$query.'%')->get();
                $output = '<ul class="dropdown-menu edutab" style="display:block; height: 265px; overflow:hidden; overflow-y:scroll;">';
                foreach($data as $row){             
                    $output .= '<li><a class="search-list" href="/college/'.$row->slug.'">'.$row->name.', '.$row->city_name->name.'</a></li>';
                }           
                $output .= '</ul>';
            }
            elseif ($result == 'course') {
                $data = Course::orderBy('name','asc')->where('name', 'like', '%'.$query.'%')->get();            
                $output = '<ul class="dropdown-menu edutab" style="display:block;">';
                foreach($data as $row){             
                    $output .= '<li><a class="search-list" href="/course/'.$row->slug.'">'.$row->name.'</a></li>';
                }           
                $output .= '</ul>';
            }
            else{
                $output = '<ul class="dropdown-menu edutab" style="display:block;">';
                $output .= '<li><a class="search-list" href="javascript:void(0)">NO Records Found</a></li>';
                $output .= '</ul>';
            }
            echo $output;
        }
    }
    /*---------------------------------------------------------------------------------------------------------------------------------------------*/

    public function autocompleteCourse(Request $request){

        $search = $request->get('term');
      
        $result = Course::select('name','id')->where('name', 'LIKE', '%'.$search.'%')->get();
 
        return response()->json($result);
    }

    public function autocompleteCollege(Request $request){

        $search = $request->get('term');
      
        $result = College::select('name','id')->where('name', 'LIKE', '%'.$search.'%')->get();
 
        return response()->json($result);
    }
}
