<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->string('slug');
            $table->text('summary');
            $table->text('synopsis');
            $table->text('where');
            $table->timestamp('when')->default(Carbon\Carbon::now());
            $table->text('cov');
            $table->enum('status', array('ACTIVE', 'PENDING', 'ENDED', 'CANCELED'))->default('PENDING');
            $table->integer('pj_limit');
            $table->integer('pj_current')->default(0);
            $table->integer('author')->unsigned();
        });

        Schema::table('games', function (Blueprint $table) {
            $table->foreign('author')->references('id')->on('users')
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
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign('articles_author_foreign');
        });
        Schema::dropIfExists('games');
    }
}
