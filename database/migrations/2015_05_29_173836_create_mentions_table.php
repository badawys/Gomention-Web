<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('mentions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('type');
            $table->integer('by_user_id')->unsigned();
            $table->integer('to_user_id')->unsigned();
            $table->json('data');
            $table->timestamps();

            $table->foreign('by_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('to_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('mentions');
	}

}
