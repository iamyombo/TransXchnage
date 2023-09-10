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
        Schema::create('servicesxmls', function (Blueprint $table) {
            $table->id();
            $table->integer('transxchanges_id');    //  TransXchnage System Foreign Key.
            $table->string('SERV_CODE');            //  Service Code.
            $table->string('SERV_PRIV_CODE');       //  Private Code.
            $table->string('SERV_LINE_ID');         //  Line id.
            $table->string('SERV_LINE_NAME');       //  Line Name.
            $table->date('SERV_OPS_DATE');       //   Operating Period Start Date
            $table->date('SERV_OPE_DATE');       //   Operating Period End Date
            $table->string('SERV_PRO_DOW_RT')->default('MondayToSunday');   // Operating Profile > Regular Day Type > Days Of Week.
            $table->string('SERV_REG_OPERATOR_REF');    //  Registered Operator Ref.
            $table->string('SERV_STOP_REQ')->default('NoNewStopsRequired');     //   Stop Requirements.
            $table->string('SERV_MODE')->default('Bus');       //   Service Mode.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicesxmls');
    }
};
