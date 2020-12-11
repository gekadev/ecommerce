<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('phone');
            $table->string('password');
            $table->string('address');
            $table->string('image')->nullable();
            $table->string('created')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('last_updated_by')->nullable();
            $table->rememberToken();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('deleted')->default(1);
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
        Schema::dropIfExists('admins');
    }
}
