<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrategyGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strategy_guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('User who created this')->index('user_id');
            $table->unsignedBigInteger('game_id')->comment('The game this strategy guide is under')->index('game_id');
            $table->string('title', 256);
            $table->text('content');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('game_id')->references('id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strategy_guides');
    }
}
