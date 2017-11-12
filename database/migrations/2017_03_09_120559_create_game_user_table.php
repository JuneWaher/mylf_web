<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('game_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });

        Schema::table('game_user', function (Blueprint $table) {
            $table->foreign('game_id')->references('id')->on('games')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_user', function(Blueprint $table) {
            $table->dropForeign('game_user_game_id_foreign');
            $table->dropForeign('game_user_user_id_foreign');
        });
        
        Schema::dropIfExists('game_user');
    }
}
