<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\College\CourseFee;

class CollegeCoursesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new CourseFee([
            'id' => $row['id'],
            'name' => $row['name'],
            'fee' => $row['fee'],
            'duration' => $row['duration'],
            'seats' => $row['seats']
        ]);
    }
}
