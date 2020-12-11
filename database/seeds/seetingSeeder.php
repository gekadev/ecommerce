<?php
use App\Models\Setting;
use Illuminate\Database\Seeder;

class seetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //start set data
        Setting::setMany([
            'default_locale'=>'ar',
            'default_timezone'=>'Africa\Cairo',
            'reviews_enabled'=>true,
            'auto_approved_refuse'=>true,
            'supported_currancies'=>['USD','LE','SAR'],
            'default_currency'=>'USD',
            'store_email'=>'test@test.com',
            'search_engine'=>'mysql',
            'local_shipping_cost'=>0,
            'outer_shipping_cost'=>0,
            'free_shipping_cost'=>0,
            'translatable' =>[
                'store_name' =>'pistauno',
                'free_shipping_label'=>'Free shipping',
                'local_label'=>'Local shipping',
                'outer_label'=>'Outer shipping'

            ],

        ]);

        /*
        *
        * this  when we want to insert data in one table
        *
        */
        /*
                Setting::create([
                    'default_locale'=>'ar',
                    'default_timezone'=>'Africa\Cairo',
                    'reviews_enabled'=>true,
                ]);
                */


    }
}
