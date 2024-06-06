<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_work_identifying_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->boolean('special_education')->nullable();
            $table->boolean('_504')->nullable();
            $table->string('current_school')->nullable();
            $table->string('academic_level')->nullable();
            $table->boolean('degree_earned')->nullable();
            $table->string('degree')->nullable();
            $table->string('current_gpa')->nullable();
            $table->string('advisor')->nullable();
            $table->string('primary_teacher')->nullable();
            $table->string('school_principle')->nullable();
            $table->string('school_telephone')->nullable();
            $table->string('school_fax')->nullable();
            $table->string('school_email')->nullable();
            $table->string('place_of_work')->nullable();
            $table->string('position_held')->nullable();
            $table->string('contact_supervisor')->nullable();
            $table->string('tel')->nullable();
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
        Schema::dropIfExists('school_work_identifying_data');
    }
};
