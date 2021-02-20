<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Contact;

class ContactsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Contact([
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'contact' => $row['contact'],
            'city' => $row['city'],
            'tenth_Percent' => $row['tenth_Percent'],
            'twelfth_Percent' => $row['twelfth_Percent'],
            'graduation_Percent' => $row['graduation_Percent'],
            'reg_id' => $row['reg_id'],
        ]);
    }
}
