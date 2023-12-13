<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;

class CommentAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $url;
    public $id;

    public function __construct($comment)
    {
        $username = $comment->user->name;
        $post = $comment->post;
        $post_title = $post->title;
        $post_id = $post->id;
        $post_owner_id = $post->user->id;
        $content = $comment->content;

        $this->message = "$username has left a comment on your post $post_title : \"$content\"";
        $this->url = "/post/$post_id";
        $this->id = $post_owner_id;

        $notification = new Notification;
        $notification->comment_id = $comment->id;
        $notification->user_id = $post_owner_id;
        $notification->save();
    }

    public function broadcastOn()
    {
        return ['channel-' . $this->id];
    }

    public function broadcastAs()
    {
        return 'notify';
    }
}
