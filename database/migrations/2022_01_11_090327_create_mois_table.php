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
            $table->integer('nb_mois');
            $table->foreignId('annee_id')->constrained();
            
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
