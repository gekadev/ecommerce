<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    /*
     * this for  realation between setting table and setting translation table
     *  for translation
     * constat methodes when we use seeders
     */
    use Translatable;
    // define with coulmn in setting table will have atranslation
    protected  $translatedAttributes=['value']; // column that will translated
    protected $with=['translations'];       //get all transalte filed
    protected $fillable=['key','plain_value','is_translatable'];
    // start casting to change type of value of feild  in stead off return with 1or 2
    protected $casts=[
        'is_translatable'=>'boolean'
    ];


    /******************** start models seders********************************
     * Determine if the user is authorized to make this request.
     *
     * constat methodes when we use seeders
     */
    // default methode to use seeders must be in all modules
    public static function setMany($setting)
    {
        foreach ($setting as $key=>$value)
        {
            self::set($key,$value);
        }

    }


    public static function set($key,$value)
    {
        if($key === 'translatable')
        {
            return static ::setTranslatableSettings($value);
        }
        // check if data is array we will use jeson encode function to save array data in data base
            if(is_array($value)){
                $value=json_encode($value);
            }
            static ::updateOrCreate(['key'=>$key],['plain_value'=>$value]);
    }

    public static function setTranslatableSettings($settings = [])
    {
        foreach ($settings as $key =>$value)
        {
            static ::updateOrCreate(['key'=>$key],[
                'is_translatable'=>true,
                'value'=>$value
            ]);
        }

    }
    /*********************************end constant sedder functions*************/

}
