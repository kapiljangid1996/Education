<?php

namespace App\Models\College;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursefee_Exam extends Model
{
    use HasFactory;

    protected $table = 'coursefee_exams';

    protected $fillable = ['course_fee_id','exam_id'];

    public function exam_name()
    {
        return $this->belongsTo('App\Models\Exam\Exam');
    }
}
