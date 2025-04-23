<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->date('dateDepart');
            $table->time('heureDepart');
            $table->string('villeDepart');
            $table->string('villeArrivee');
            $table->float('prix');
            $table->integer('placesDisponibles');
            $table->boolean('animauxAutorises');
            $table->boolean('fumeursAutorises');
            $table->boolean('bagagesAutorises');
            $table->string('typesBagages'); // JSON string
            $table->foreignId('vehicule_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // conducteur

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
