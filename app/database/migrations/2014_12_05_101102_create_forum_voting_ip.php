<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumVotingIp extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('forum_voting_ip', function(Blueprint $table) {
            $table->increments('id');
            $table->string('ip_add', 40);
            $table->integer('forum_comments_id')->unsigned();
            $table->foreign('forum_comments_id')->references('id')->on('forum_comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('forum_voting_ip');
    }

}
