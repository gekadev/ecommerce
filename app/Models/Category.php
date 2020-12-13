<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    use Translatable ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes for translations.
     *
     * @var array
     */
    protected  $translatedAttributes = ['name','description'];
    protected $with = ['translations'];
    /**
     *
     * The attributes castiong to specific value.
     *
     * @var array
     */
    protected $casts = [
        'is_translatable'=>'boolean',
    ];

    /**
     * The attributes for hidden serializatione.to  make translation hidden and call it when we need
     *
     * @var array
     */

    protected $hidden =['translations'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
}
