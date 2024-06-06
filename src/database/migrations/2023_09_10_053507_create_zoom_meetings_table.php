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
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->string('uuid');
            $table->unsignedBigInteger('zoom_id');
            $table->string('host_email');
            $table->string('host_id');
            $table->string('topic');
            $table->string('type');
            $table->string('status');
            $table->dateTime('start_time');
            $table->string('duration');
            $table->string('timezone');
            $table->dateTime('zoom_created_time');
            $table->text('start_url');
            $table->text('join_url');
            $table->string('password');
            $table->string('h323_password');
            $table->string('pstn_password');
            $table->string('encrypted_password');
            $table->boolean('pre_schedule')->default(0);
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
        Schema::dropIfExists('zoom_meetings');
    }
};
