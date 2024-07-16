<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulaireContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulaire_contrats', function (Blueprint $table) {
            $table->id();
            $table->date('dateEmbauche');
            $table->string('poste');
            $table->string('nomEmploye');
            $table->string('dureeContrat')->nullable();
            $table->string('lieuTravail');
            $table->string('adresseSiegeSocial');
            $table->string('salaire');
            $table->string('nomEntreprise');
            $table->string('regimeHebdomadaire');
            $table->string('baseHebdomadaire');
            $table->string('heureDebutHiver');
            $table->string('dureePauseDejeunerHiver');
            $table->string('heureDebutPauseDejeunerHiver');
            $table->string('heureFinPauseDejeunerHiver');
            $table->string('dureeTravailEffectifHiver');
            $table->string('heureDebutEte');
            $table->string('dureePauseEte');
            $table->string('heureDebutPauseEte');
            $table->string('heureFinPauseEte');
            $table->string('dureeTravailEffectifEte');
            $table->string('nbJoursConges');
            $table->string('villeJuridiction');
            $table->string('signature')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formulaire_contrats');
    }
}
