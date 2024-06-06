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
        Schema::create('initial_evaluations', function (Blueprint $table) {
            $table->id();
            // Identifying Data 
            $table->string('client_name')->nullable();
            $table->string('ssn')->nullable();
            $table->string('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('legal_gurdian')->nullable();
            $table->string('relationship')->nullable();
            $table->text('current_address')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('email')->nullable();
            // Insurance Data
            $table->string('pr_inc_name')->nullable();
            $table->string('pr_inc_id')->nullable();
            $table->string('pr_inc_group')->nullable();
            $table->string('sec_inc_name')->nullable();
            $table->string('sec_inc_id')->nullable();
            $table->string('sec_inc_group')->nullable();
            $table->string('spouse_pr_inc_name')->nullable();
            $table->string('spouse_pr_inc_id')->nullable();
            $table->string('spouse_pr_inc_group')->nullable();
            $table->string('spouse_sec_inc_name')->nullable();
            $table->string('spouse_sec_inc_id')->nullable();
            $table->string('spouse_sec_inc_group')->nullable();
            $table->integer('com_inc_policy')->comment( '1 = Yes, 2 = No')->nullable();
            $table->integer('still_current')->comment( '1 = Yes, 2 = No')->nullable();
            $table->integer('cov_expire')->comment( '1 = Yes, 2 = No')->nullable();
            $table->integer('parents_married')->comment( '1 = Yes, 2 = No')->nullable();
            $table->integer('parents_divorce')->comment( '1 = Yes, 2 = No')->nullable();
            $table->string('legal_custody')->nullable();
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
        Schema::dropIfExists('initial_evaluations');
    }
};
