<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;



class TagsTranslation extends Model
{

    /**
     * The table name.
     *
     * @var array
     */
    protected $table="tag_translations";

    /**
     * The table name.
     *
     * @var array
     */
    protected $guarded=[];
    public  $timestamps=false;
}
