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
        Schema::create('routesxmls', function (Blueprint $table) {
            $table->id();
            $table->Integer('transxchanges_id'); // TransXchnage System Foreign Key.
            $table->string('RID'); // Routes Id.
            $table->string('privatecode'); // Route Private Code.
            $table->text('description'); // Route Description.
            $table->string('routesectionref'); // Route Section Ref.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routesxmls');
    }
};
