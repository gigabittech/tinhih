<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->boolean('child_covered_by_any_other_insurance')->nullable();
            $table->string('what_state_is_the_coverage_in')->nullable();
            $table->string('insurance_name')->nullable();
            $table->string('insurance_id')->nullable();
            $table->string('insurance_group')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_insurances');
    }
};
