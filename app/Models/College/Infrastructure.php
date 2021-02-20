<?php

namespace App\Models\College;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infrastructure extends Model
{
    use HasFactory;

    protected $table = 'college_infrastructures';

    protected $fillable = ['name','long_description','college_id'];

    public static function storeInfrastructure($request)
    {
    	$request->validate([
            'addmore.*.name' => 'required',
            'addmore.*.long_description' => 'sometimes|nullable',
            'addmore.*.college_id' => 'required',
        ]);
        foreach ($request->addmore as $key => $value) {
            Infrastructure::create($value);
        }
    }

    public static function editInfrastructure($request,$id)
    {
        $request->validate([
            'addmore.*.name' => 'required',
            'addmore.*.long_description' => 'sometimes|nullable',
            'addmore.*.college_id' => 'required',
        ]);

        $id_college = $request->input('id_college');

        Infrastructure::where('college_id',$id_college)->delete();

        foreach ($request->addmore as $key => $value) {
            
            Infrastructure::create($value);
        }
    }
}
