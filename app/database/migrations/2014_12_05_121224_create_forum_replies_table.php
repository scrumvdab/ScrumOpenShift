<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forum_replies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('body');
			$table->integer('group_id');
			$table->integer('category_id');
			$table->integer('thread_id');
                        $table->integer('comment_id');
			$table->integer('author_id');
                        $table->integer('like');
                        $table->integer('dislike');
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
		Schema::drop('forum_replies');
	}

}

