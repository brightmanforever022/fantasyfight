<?php

namespace App\Exports;

use App\Models\GameUser as GameUser;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GameUser::all(["name", "email"]);
    }
}
