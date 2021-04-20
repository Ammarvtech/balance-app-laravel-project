<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureTranslationsTable extends Migration
{
    public function up()
    {
       Schema::create('feature_translations', function (Blueprint $table) {
           // mandatory fields
           $table->increments('id'); // Laravel 5.8+ use bigIncrements() instead of increments()
           $table->string('locale')->index();

           // Foreign key to the main model
           $table->unsignedBigInteger('feature_id');
           $table->unique(['feature_id', 'locale']);
        
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_translations');
    }
}
