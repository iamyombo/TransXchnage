<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehiclejourneyxmls', function (Blueprint $table) {
            $table->id();
            $table->integer('transxchanges_id');    // TransXchnage System Foreign Key.
            $table->string('VJ_PRIVATE_CODE');   // Vehicle Journey Private Code.
            $table->string('VJ_OBD');   // Operational Block Description.
            $table->string('VJ_OBN');   // Operational Block Number.
            $table->string('VJ_TMSC');   // Ticket Machine Service Code.
            $table->string('VJ_TMJC');   // Ticket Machine Journey Code.
            $table->string('VJ_PRD')->default('Monday To Friday');   // Operational Profile Regular Day Of Week.
            $table->string('VJ_PBH')->default('All Bank Holiday'); ;   // Operational Profile Bank Holiday.
            $table->string('VJ_LOPD');   // Layover Point Duration.
            $table->string('VJ_LOPN');   // Layover Point Name.
            $table->string('VJ_LOLONG');   // Location Longitude.
            $table->string('VJ_LOLATI');   // Location Latitude.
            $table->string('VJ_GAGREF');   // Garage Reference
            $table->string('VJ_CODE');   // Vehicle Journey Code.
            $table->string('VJ_SERVICEREF');   // Service Reference.
            $table->string('VJ_LINEREF');   //Line Reference.
            $table->string('VJ_JPR');   // Journey Pattern Reference.
            $table->string('VJ_DT');   // Vehicle Departure Time.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiclejourneyxmls');
    }
};
