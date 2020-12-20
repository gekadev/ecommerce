<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryReport extends Model
{
    /**
     * The table name.
     *
     * @var array
     */
    protected $table="category_report";

    /**
     * The table name.
     *
     * @var array
     */
    protected $guarded=[];
    public  $timestamps=false;


    public function scopeIsExist($query ,$id)
    {
        return $query->where(['deleted' => 1, 'id' => $id])->orderBy('id', 'DESC');
    }
}
