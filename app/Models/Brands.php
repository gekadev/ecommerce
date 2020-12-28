<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use Translatable ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected  $translatedAttributes=['name'];
    /**
     * The attributes for translations.
     *
     * @var array
     */
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

    public function scopeAllbrands($query)
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
    public function getImageAttribute($value)
    {
        return($value !==null)? asset('upload/'.$value):null;
    }
    /***************************relationd*************/
    // get relation ship
    public function brandReports()
    {
        return $this->hasOne(BrandsReports::class,'brand_id','id');
    }

}
