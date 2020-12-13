<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryReportModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_report', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('total')->default(0);
            $table->tinyInteger('deleted')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('created_by');
            $table->tinyInteger('last_updated_by');
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
        Schema::dropIfExists('category_report_models');
    }
}
