<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    public $users;

    public function __construct($users)
    {
       $this->users=$users;

       
    }
    public function view(): View
    {      
        return view('export.user_export',[
            'users' => $this->users
            ]);
       
    }
}