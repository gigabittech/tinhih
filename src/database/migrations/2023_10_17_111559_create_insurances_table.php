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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('primary_insurance_name')->nullable();
            $table->string('primary_insurance_id')->nullable();
            $table->string('primary_insurance_group')->nullable();
            $table->string('secondary_insurance_name')->nullable();
            $table->string('secondary_insurance_id')->nullable();
            $table->string('secondary_insurance_group')->nullable();
            $table->string('spouse_primary_insurance_name')->nullable();
            $table->string('spouse_primary_insurance_id')->nullable();
            $table->string('spouse_primary_insurance_group')->nullable();
            $table->string('spouse_secondary_insurance_name')->nullable();
            $table->string('spouse_secondary_insurance_id')->nullable();
            $table->string('spouse_secondary_insurance_group')->nullable();
            $table->boolean('commercial_insurance_policy')->comment( '1 = Yes, 2 = No')->nullable();
            $table->boolean('policy_still_current')->comment( '1 = Yes, 2 = No')->nullable();
            $table->boolean('coverage_expire')->comment( '1 = Yes, 2 = No')->nullable();
            $table->date('expiration_date')->nullable();
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
        Schema::dropIfExists('insurances');
    }
};
