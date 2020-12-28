<?php

namespace App\Exports;

use App\Models\Brands;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BrandsExport implements FromView
{
    public function view(): View
    {
        return view('dashboard.brand.csv', [
            'allbrands' => Brands::Allbrands()->get(),
        ]);
    }
}

