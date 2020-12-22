<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AdminsExport implements FromView
{
    public function view(): View
    {
        return view('dashboard.profile.csv', [
            'alladmins' => Admin::where(['deleted' =>1])->get(),
        ]);
    }
}

