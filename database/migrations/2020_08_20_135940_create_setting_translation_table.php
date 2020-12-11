<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//$2y$10$ORN6VCZfsDyWMeSWdzRyyeppjh3CFku.taTnKH.NhJU5NhcPPioDm

class CreateSettingTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('setting_id')->unsigned();
            $table->string('locale');
            $table->longText('value')->nullable();
            $table->integer('created_by')->nullable();
            $table->unique(['setting_id','locale']);
            $table->integer('last_updated_by')->nullable();
           // $table->foreign('setting_id')->references('id')->on('settings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_translations', function (Blueprint $table) {
            //
        });
    }
}
