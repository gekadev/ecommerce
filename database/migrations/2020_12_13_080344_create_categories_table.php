<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('image')->nullable();
            $table->mediumText('url')->nullable();
            $table->mediumText('slug')->unique();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('deleted')->default(1);
            $table->string('created')->nullable();
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('last_updated_by')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
