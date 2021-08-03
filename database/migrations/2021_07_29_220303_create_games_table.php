<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description');
            $table->string('developer', 100);
            $table->string('tags', 100);
            $table->string('banner', 100);
            $table->string('cover', 1024)->comment("An array of URLs that contain background images");
            $table->integer('steamappid')->default(0)->comment("The steam app ID (if applicable)");
            $table->boolean('news')->default(0)->comment("If the game has news or not (steam games only)");
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
        Schema::dropIfExists('games');
    }
}
