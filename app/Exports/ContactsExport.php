<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Contact;

class ContactsExport implements FromCollection, WithHeadings
{
    /**
    * @param Collection $collection
    */

    public function collection()
    {
        return Contact::select('id','name','email','contact','city','tenth_Percent','twelfth_Percent','graduation_Percent','reg_id')->where('type','inquiry')->get();
    }

    public function headings() : array{
        return [
            'Id',
            'Name',
            'Email',
            'Contact',
            'City',
            'tenth_Percent',
            'twelfth_Percent',
            'graduation_Percent',
            'reg_id'
        ];
    }

}
