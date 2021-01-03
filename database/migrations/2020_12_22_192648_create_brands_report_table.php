<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('brand_id')->length(11);
            $table->integer('total_products')->default(0);
            $table->tinyInteger('deleted')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('last_updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_report');
    }
}
