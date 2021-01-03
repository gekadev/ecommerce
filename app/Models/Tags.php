<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;


class Tags extends Model
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
    protected  $translatedAttributes = ['name'];
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


    public function scopeAllTags($query)
    {
        return $query ->where('deleted',1);
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
