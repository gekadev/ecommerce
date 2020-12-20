<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CategoryExport implements FromView
{
    public function view(): View
    {
        return view('dashboard.category.csv', [
            'allCategories' => Category::Allcategories()->get(),
        ]);
    }
}

