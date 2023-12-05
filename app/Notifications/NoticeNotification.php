<?php

namespace App\Notifications;

use App\Models\notices;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NoticeNotification extends Notification implements ShouldBroadcast
{
    use Queueable;
    protected $notice;
    protected $user;

    public function __construct($user, $notices)
    {
        $not =  notices::find($notices);
        $this->notice = $not;
        $this->user = $user;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'title' => $this->notice->heading,
            'description' => $this->notice->description,
            'date' => $this->notice->created_at
        ];
    }
    public function toBroadcast(object $notifiable)
    {
        $notification = [
            'data' => [
                'user_id' => $this->user->id,
                'user_name' => $this->user->name,
                'title' => $this->notice->heading,
                'description' => $this->notice->description,
                'date' => $this->notice->created_at
            ]
        ];

        return new BroadcastMessage([
            'noticication' => $notification
        ]);
    }
}
