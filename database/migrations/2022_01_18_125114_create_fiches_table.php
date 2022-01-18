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
            $table->string('chemin_fiche');
            $table->boolean('envoye(O/N)');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->unsignedBigInteger('annee_id');
            $table->foreign('annee_id')->references('id')->on('annees');

            $table->integer('mois_id'); 
            $table->foreign('mois_id')->references('mois_id')->on('mois');
            
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
