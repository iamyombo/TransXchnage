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
        Schema::create('jpsectionxmls', function (Blueprint $table) {
            $table->id();
            $table->Integer('transxchanges_id'); // TransXchnage System Foreign Key.
            $table->string('JPSID'); //Journey Pattern Session ID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jpsectionxmls');
    }
};
