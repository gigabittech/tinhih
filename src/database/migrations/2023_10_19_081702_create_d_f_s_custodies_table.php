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
        Schema::create('d_f_s_custodies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->boolean('dfs_custody_of_your_children')->nullable();
            $table->string('dfs_caseworker')->nullable();
            $table->string('dfs_tel')->nullable();
            $table->string('dfs_email')->nullable();
            $table->string('dfs_location')->nullable();
            $table->string('child_probation_officer')->nullable();
            $table->string('child_probation_officer_tel')->nullable();
            $table->string('juvenile_Justice_Custody_of_your_child')->nullable();
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
        Schema::dropIfExists('d_f_s_custodies');
    }
};
