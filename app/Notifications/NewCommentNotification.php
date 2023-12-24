<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Controllers\CommentController;
class NewCommentNotification extends Notification
{
    use Queueable;


    protected $comment;
    protected $post;

  /**
     * Create a new notification instance.
     *
     * @param Comment $comment
     * @param Post $post
     */
    public function __construct(Comment $comment, Post $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $comment = $this->comment;
        $post = $this->post;
        $post_id =$post->id ;
        $url = url('/post/'.$post_id); 
        return (new MailMessage)
       
                    ->line('New comment on your post!')
                    ->line("{$comment->user->name} commented on your post:")
                    ->line($comment->content)
                    ->action('View Post',  $url)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
