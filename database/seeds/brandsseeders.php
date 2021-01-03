<?php

use Illuminate\Database\Seeder;
use App\Models\Brands;

class brandsseeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Brands ::class ,3) ->create();
    }
}
