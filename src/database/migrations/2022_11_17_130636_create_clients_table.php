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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('ssn')->nullable();
            $table->date('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('legal_guardian')->nullable();
            $table->string('relationship')->nullable();
            $table->text('address')->nullable();
            $table->string('cell_phone')->nullable();
            $table->boolean('are_parents_married')->nullable();
            $table->boolean('are_parents_divorced')->nullable();
            $table->string('legal_custody')->nullable();
            $table->string('language')->nullable();
            $table->string('cultural_background')->nullable();
            $table->text('client_image')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
