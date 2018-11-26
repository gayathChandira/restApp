<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use App\FoodItem;

class NotifyUser extends Notification
{
    use Queueable;
    private $fd;
    
    public function __construct(FoodItem $fd)
    {
        $this->fd = $fd;
    }

    
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'id'=>1,
            'data' => $this->fd
        ];
    }
    
    public function toDatabase($notifiable)
    {
        return [
            'id'=>1,
            'data' => $this->fd
        ];
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
