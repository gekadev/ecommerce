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

    /**
     * start our methods
     *
     * @var array
     */


    public function scopeAllcategories($query)
    {
        return $query ->where('deleted',1);
    }

    public function scopeParent($query)
    {
        return $query->where('deleted',1)
                     ->wherenull('parent_id');
    }

    public function scopeChiled($query)
    {
        return $query->where('deleted',1)
                     ->whereNotnull('parent_id');
    }


    public function scopeIsExist($query ,$id)
    {
        return $query->where(['deleted' => 1, 'id' => $id])->orderBy('id', 'DESC');
    }

    public function getActive()
    {
        return  $this->status == 1 ? 'مفعل':'غ.مفعل';

    }

}
