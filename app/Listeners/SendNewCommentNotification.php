<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewComment; 
use App\Notifications\NewCommentNotification;

class SendNewCommentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewComment  $event)
    {
        $user = $event->getUser();
        $comment = $event->comment;
        $post = $comment->post;

        $user->notify(new NewCommentNotification($comment,$post));
    }
    
}
