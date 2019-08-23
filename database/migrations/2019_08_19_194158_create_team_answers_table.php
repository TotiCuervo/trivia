<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('round_id');
            $table->string('gameCode');
            $table->string('answer');
            $table->boolean('correct');
            $table->unsignedBigInteger('matchIndex');
            $table->unsignedBigInteger('points');
            $table->string('powerUp')->nullable();
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
        Schema::dropIfExists('team_answers');
    }
}
