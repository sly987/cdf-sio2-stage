<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiches', function (Blueprint $table) {
            $table->id();
            $table->string('chemin_fiche')->nullable();
            $table->boolean('envoye')->default(0);
            $table->boolean('confirme')->default(0);
            $table->timestamps();


            $table->foreignId('user_id')->constrained();
            $table->foreignId('mois_id')->constrained();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fiches');
    }
}
