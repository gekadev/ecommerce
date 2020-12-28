<?php

namespace App\Models;
use App\Models\Brands;
use Illuminate\Database\Eloquent\Model;

class BrandsReports extends Model
{

    protected $table="brand_report";
    protected $guarded=[];
    public  $timestamps=true;

    public function Brand()
    {
        return $this->belongsTo(Brands::class);

    }

}
