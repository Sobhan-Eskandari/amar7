<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->text('header_txt')->nullable();
            $table->string('header_img')->nullable();
            $table->text('thSlider_txt')->nullable();
            $table->string('thSlider_img')->nullable();
            $table->text('ndSlider_txt')->nullable();
            $table->string('ndSlider_img')->nullable();
            $table->text('rdSlider_txt')->nullable();
            $table->string('rdSlider_img')->nullable();
            $table->string('contactUs_img')->nullable();
            $table->string('email')->nullable();
            $table->string('number')->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('aparat')->nullable();
            $table->text('aboutUs_txt')->nullable();
            $table->string('aboutUs_img')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
