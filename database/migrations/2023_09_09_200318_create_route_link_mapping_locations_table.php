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
        Schema::create('route_link_mapping_locations', function (Blueprint $table) {
            $table->id();
            $table->string('RL_TML_ID'); // Route Link ID.
            $table->string('RL_TML_LONGITUDE'); // Route Link Track Mapping Location Longitude.
            $table->string('RL_TML_LATITUDE'); // Route Link Track Mapping Location Latitude.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_link_mapping_locations');
    }
};
