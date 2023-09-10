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
        Schema::create('nptg_localities_anlrs', function (Blueprint $table) {
            $table->id();
            $table->Integer('transxchanges_id'); // TransXchnage System Foreign Key
            $table->string('anlr_ref'); // AnnotatedNptgLocalityRef
            $table->string('anlr_name');    //LocalityName
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nptg_localities_anlrs');
    }
};
