<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{

    private $birth_date_start;
    private $birth_date_end;

    public function __construct($birth_date_start, $birth_date_end)
    {
        $this->birth_date_start = $birth_date_start;
        $this->birth_date_end = $birth_date_end;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('birth_date', '>=', $this->birth_date_start)
            ->where('birth_date', '<=', $this->birth_date_end)->get(['id', 'name', 'email', 'birth_date']);
    }
}
