<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->nullable(false);
            $table->string('lesson_name')->nullable(false);
            $table->text('lesson_desc')->nullable(false);
            $table->string('instructor')->nullable(false);
            $table->text('instructor_desc')->nullable(false);
            $table->string('cost')->nullable();
            $table->string('media')->nullable(false);
            $table->bigInteger('seen')->nullable(false)->default(0);
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
        Schema::dropIfExists('lessons');
    }
}
