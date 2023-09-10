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
        Schema::create('route_links', function (Blueprint $table) {
            $table->id();
            $table->string('RSID'); // Routs Session ID Foreign Key from Routesections table.
            $table->string('RLID'); // Route Link ID.
            $table->string('RL_FROM_STOP_POINT_REF'); // Route Link FROM stop point Ref = Stop point ATCODE.
            $table->string('RL_TO_STOP_POINT_REF'); // Route Link TO stop point Ref = Stop point ATCODE.
            $table->string('RL_DISTANCE'); // Route Link Distance.
            $table->string('RL_DIRECTION'); // Route Link Direction.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_links');
    }
};
