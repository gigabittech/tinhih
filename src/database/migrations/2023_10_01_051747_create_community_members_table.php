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
        Schema::create('community_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name')->nullable();
            $table->string('dob')->nullable();
            $table->integer('gender')->comment('1 = Male, 2 = Female, 3 = Non Binary, 4 = Prefer Not')->nullable();
            $table->text('community_member_image')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('recovery_date')->nullable();
            $table->string('recovery_program')->nullable();
            $table->string('support_services')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->json('additional_info')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('community_members');
    }
};
