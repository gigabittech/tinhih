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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('gauth_id')->nullable();
            $table->string('gauth_type')->nullable();
            $table->string('social_login_provider_name')->nullable();
            $table->string('social_login_user_id')->nullable();

            $table->string('name');

            $table->enum('type',['super_admin','admin','provider','client','community_member'])->default('client');

            $table->string('phone')->nullable()->unique();
            $table->string('email')->unique();
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_active')->default(0);
            $table->boolean('is_new')->default(1);
            $table->boolean('is_blocked')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
