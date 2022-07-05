<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->dateTimeTz('utcDate');
            $table->string('status');
            $table->json('area');
            $table->json('competition');
            $table->json('season');
            $table->json('homeTeam');
            $table->json('awayTeam');
            $table->json('score');
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
        Schema::dropIfExists('matches');
    }
}
