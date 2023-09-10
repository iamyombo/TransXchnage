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
        Schema::create('jptiminglinkxmls', function (Blueprint $table) {
            $table->id();
            $table->string('JPSID'); //Journey Pattern Session ID
            $table->string('JPTLID'); // Journey Pattern Timing Link ID Foreign Key from jpsectionxmls table.
            $table->string('JPTL_FROM_SEQUENCE'); //  FROM Sequence.
            $table->string('JPTL_ACTIVITY_FROM'); // FROM Activity.
            $table->string('JPTL_FROM_DDD'); // FROM Dynamic Destination Display.
            $table->string('JPTL_FROM_STOP_POINT_REF'); // FROM StopPointRef.
            $table->string('JPTL_FROM_TIMING_STATUS'); // FROM Timing Status.
            $table->string('JPTL_TO_SEQUENCE'); // TO Sequence.
            $table->string('JPTL_ACTIVITY_TO'); // TO Activity.
            $table->string('JPTL_TO_DDD'); // TO Dynamic Destination Display.
            $table->string('JPTL_TO_STOP_POINT_REF'); // TO StopPointRef.
            $table->string('JPTL_TO_TIMING_STATUS'); // TO Timing Status.
            $table->string('JPTL_ROUTE_LINK_REF'); // Route Link Ref Linked to ROUTE LINK ID (route_links:RLID)
            $table->string('JPTL_RUNTIME'); // Journey Pattern Timing Run Time.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jptiminglinkxmls');
    }
};
