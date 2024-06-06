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
        Schema::create('prior_treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('previous_therapy')->nullable();
            $table->string('location')->nullable();
            $table->date('dates')->nullable();
            $table->text('goals')->nullable(false);
            $table->string('medication_name')->nullable();
            $table->string('medication_purpose')->nullable();
            $table->string('medication_dosage')->nullable();
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
        Schema::dropIfExists('prior_treatments');
    }
};
