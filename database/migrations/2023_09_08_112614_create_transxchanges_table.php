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
        Schema::create('transxchanges', function (Blueprint $table) {
            $table->id();
            $table->string('xmlFileName'); // XML File Name.
            $table->string('xmlModStatus');    // XML File Modification Status.
            $table->string('xmlCreateDate'); // XML File Modification Date.
            $table->string('xmlModDate');    // XML File Modification Date.
            $table->integer('xmlRevisionNo'); // XML File Revision No.
            $table->string('xmlSchemaVer');   // XML SchemaVersion.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transxchanges');
    }
};
