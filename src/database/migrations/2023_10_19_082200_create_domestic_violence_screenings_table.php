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
        Schema::create('domestic_violence_screenings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->boolean('violent_in_the_home')->nullable();
            $table->text('violent_in_the_home_describe')->nullable();
            $table->boolean('child_has_been_violent_in_the_home')->nullable();
            $table->text('child_has_been_violent_in_the_home_describe')->nullable();
            $table->boolean('my_spouse_has_been_violent_in_the_home')->nullable();
            $table->text('my_spouse_has_been_violent_in_the_home_describe')->nullable();
            $table->boolean('witnessed_domestic_violence')->nullable();
            $table->text('witnessed_domestic_violence_describe')->nullable();
            $table->boolean('weapons')->nullable();
            $table->text('weapons_describe')->nullable();
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
        Schema::dropIfExists('domestic_violence_screenings');
    }
};
