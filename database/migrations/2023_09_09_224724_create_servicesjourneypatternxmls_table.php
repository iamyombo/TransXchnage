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
        Schema::create('servicesjourneypatternxmls', function (Blueprint $table) {
            $table->id();
            $table->string('SERV_CODE');    //  Service Code.
            $table->string('SERV_JPID');    //  Service Journey Pattern id.
            $table->string('SERV_JPID_DDD');    //  Service Journey Pattern Destination Display.
            $table->string('SERV_JPID_DIRECTION');  //  Service Journey Pattern Direction.
            $table->string('SERV_JPID_ROUTE_REF');  //  Service Journey Pattern Route Ref. ထ
            $table->string('SERV_JPID_JOURNEYPS_REF');  //  Service Journey Pattern Section Refs. ထ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicesjourneypatternxmls');
    }
};
