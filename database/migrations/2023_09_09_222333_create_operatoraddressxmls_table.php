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
        Schema::create('operatoraddressxmls', function (Blueprint $table) {
            $table->id();
            $table->string('OA_OPT_ID');   // Operator Id Foreign Key from Operatorxmls table.
            $table->string('OA_OPT_LINE_XMLNS'); //  Operator Address XML Namespace.
            $table->string('OA_OPT_LINE_TEXT'); //  Operator Address
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operatoraddressxmls');
    }
};
