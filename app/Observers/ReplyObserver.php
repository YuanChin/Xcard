<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body'); 
    }

    public function created(Reply $reply)
    {
        $reply->topic->updateReplyCount();

        // 通知文章作者有新評論~
        $reply->topic->user->notify(new TopicReplied($reply));

    }

    public function deleted(Reply $reply)
    {
        $reply->topic->updateReplyCount();
    }
}