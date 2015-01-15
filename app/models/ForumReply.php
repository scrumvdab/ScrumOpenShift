<?php

class ForumReply extends Eloquent {

    protected $table = 'forum_replies';

    public function repliesreplies() {
        return $this->hasMany('ForumReplyReply', 'reply_id');
    }
    
    public function group() {
        $this->belongsTo('ForumGroup');
    }

    public function category() {
        $this->belongsTo('ForumCategory');
    }

    public function thread() {
        $this->belongsTo('ForumThread');
    }
    
    public function comment() {
        $this->belongsTo('ForumComment');
    }

    public function author() {
        return $this->belongsTo('User');
    }

}
