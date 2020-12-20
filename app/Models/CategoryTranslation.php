<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    /**
     * The table name.
     *
     * @var array
     */
    protected $table="category_translations";

    /**
     * The table name.
     *
     * @var array
     */
    protected $guarded=[];
    public  $timestamps=false;
}
