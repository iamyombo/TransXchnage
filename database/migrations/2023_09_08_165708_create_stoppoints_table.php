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
        Schema::create('stoppoints', function (Blueprint $table) {
            $table->id();
            $table->Integer('transxchanges_id'); // TransXchnage System Foreign Key.
            $table->string('creationdate'); // Stoppoints CreationDate CDATE to retrieve.
            $table->string('atcocode');     // Stoppoints AtcoCode.
            $table->string('dcname');       // Stoppoints Descriptor Common Name.
            $table->string('pnptgref'); // Stoppoints Place NptgLocalityRef.
            $table->float('pllong');    // Stoppoints Place Location Longitude.
            $table->float('pllati');    // Stoppoints Place Location Latitude.
            $table->string('sctype');    // Stoppoints Stop Classification Type.
            $table->string('baystatus');    // Stoppoints Stop Classification Offstreet Bus & Coach.
            $table->string('aaref');    //Stoppoint Administrative Area Ref.
            $table->text('notes');    //Stoppoint Notes.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoppoints');
    }
};
