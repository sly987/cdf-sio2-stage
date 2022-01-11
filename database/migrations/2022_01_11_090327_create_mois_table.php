<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mois', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('annee_id');
            $table->foreign('annee_id')->references('id')->on('annees');
            
        });
        DB::statement("ALTER TABLE mois AUTO_INCREMENT = 1;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mois');
    }
}
