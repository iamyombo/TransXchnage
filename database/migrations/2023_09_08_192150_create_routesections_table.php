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
        Schema::create('routesections', function (Blueprint $table) {
            $table->id();
            $table->Integer('transxchanges_id'); // TransXchnage System Foreign Key.
            $table->string('RSID'); // Routes Sections Id.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routesections');
    }
};
