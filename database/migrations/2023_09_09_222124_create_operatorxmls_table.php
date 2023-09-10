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
        Schema::create('operatorxmls', function (Blueprint $table) {
            $table->id();
            $table->integer('transxchanges_id');    // TransXchnage System Foreign Key.
            $table->string('OPT_ID');   // Operator Id.
            $table->string('OPT_NOC');  // National Operator Code.
            $table->string('OPT_OSN');  // Operator Short Name.
            $table->string('OPT_ONOL'); // Operator Name On Licence.
            $table->string('OPT_TRADING NAME'); // Trading Name.
            $table->string('OPT_LN');   // Licence Number.
            $table->string('OPT_LC');   // Licence Classification.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operatorxmls');
    }
};
