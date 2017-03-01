<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWikiWikiCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_wiki_categories', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('wiki_id')->unsigned();
            $table->bigInteger('wiki_categories_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_wiki_categories');
    }
}
