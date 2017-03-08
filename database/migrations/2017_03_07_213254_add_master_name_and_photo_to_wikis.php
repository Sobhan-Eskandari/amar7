<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMasterNameAndPhotoToWikis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wikis', function (Blueprint $table) {
            $table->string('master_name');
            $table->string('master_photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wikis', function (Blueprint $table) {
            $table->dropColumn('master_name');
            $table->dropColumn('master_photo');
        });
    }
}
