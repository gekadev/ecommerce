<?php

namespace App\Exports;

use App\Models\Tags;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TagExport implements FromView
{
    public function view(): View
    {
        return view('dashboard.tags.csv', [
            'allTags' => Tags::AllTags()->get(),
        ]);
    }
}

