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
        Schema::create('mothers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->boolean('mother_type')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_ssn')->nullable();
            $table->date('mother_dob')->nullable();
            $table->string('mother_current_address')->nullable();
            $table->string('mother_home_phone')->nullable();
            $table->string('mother_cell_phone')->nullable();
            $table->string('mother_email')->nullable();
            $table->boolean('client_live_with_the_mother')->nullable();
            $table->boolean('mother_health_insurance_for_client')->nullable();
            $table->string('mother_primary_insurance_name')->nullable();
            $table->string('mother_primary_insurance_id')->nullable();
            $table->string('mother_primary_insurance_group')->nullable();
            $table->string('mother_secondary_insurance_name')->nullable();
            $table->string('mother_secondary_insurance_id')->nullable();
            $table->string('mother_secondary_insurance_group')->nullable();
            $table->boolean('step_living_with_the_client')->nullable();
            $table->boolean('health_insurance_policy')->nullable();
            $table->string('coverage_in')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_name_ssn')->nullable();
            $table->date('parent_name_dob')->nullable();
            $table->text('parent_current_address')->nullable();
            $table->string('parent_home_phone')->nullable();
            $table->string('parent_cell_phone')->nullable();
            $table->string('parent_email')->nullable();
            $table->string('parent_primary_insurance_name')->nullable();
            $table->string('parent_primary_insurance_id')->nullable();
            $table->string('parent_primary_insurance_group')->nullable();
            $table->string('parent_secondary_insurance_name')->nullable();
            $table->string('parent_secondary_insurance_id')->nullable();
            $table->string('parent_secondary_insurance_group')->nullable();
            $table->string('initials')->nullable();

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
        Schema::dropIfExists('mothers');
    }
};