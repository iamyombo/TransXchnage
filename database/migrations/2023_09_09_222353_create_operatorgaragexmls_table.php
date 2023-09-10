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
        Schema::create('operatorgaragexmls', function (Blueprint $table) {
            $table->id();
            $table->string('OPT_ID');   // Operator Id Foreign Key from Operatorxmls table.
            $table->string('GAG_CODE'); //  Garage Code
            $table->string('GAG_NAME'); //  Garage Name
            $table->string('GAG_LOCATION_LONGITUDE');   // Location Longitude
            $table->string('GAG_LOCATION_LATITUDE');    // Location Latitude
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operatorgaragexmls');
    }
};
