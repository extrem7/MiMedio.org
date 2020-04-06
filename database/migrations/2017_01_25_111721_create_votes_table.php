<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate:rollback --path=/database/migrations/2017_01_25_111721_create_votes_table.php
     * @return void
     */
    public function up()
    {
        Schema::create('larapoll_votes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('option_id');
            $table->timestamps();

            $table->foreign('option_id')->references('id')->on('larapoll_options');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('poll_votes');
    }
}
