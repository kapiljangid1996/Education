<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\College\CourseFee;

class CollegeCoursesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

function __construct($id) {
$this->id = $id;
}

    public function collection()
    {
        return CourseFee::select('id','name','fee','duration','seats')->where('college_id',$this->id)->get();
    }

    public function headings() : array{
        return [
            'Id',
            'Name',
            'Fee',
            'Duration',
            'Seats'
        ];
    }
}
