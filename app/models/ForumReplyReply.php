<?php

class ForumReplyReply extends Eloquent {

    protected $table = 'forum_replies_replies';
    
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
    
    public function replies() {
        $this->belongsTo('ForumReply');
    }

    public function author() {
        return $this->belongsTo('User');
    }

}
