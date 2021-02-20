<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'rating', 'headline', 'description', 'college_id'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

	public function college()
	{
	    return $this->belongsTo('App\Models\College\College');
	}
}
