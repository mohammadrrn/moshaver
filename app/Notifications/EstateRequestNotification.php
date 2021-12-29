<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EstateRequestNotification extends Notification
{
    use Queueable;

    private $description = null;
    private $link = null;
    private $estateRequestId = null;

    public function __construct($description, $link)
    {
        $this->description = $description;
        $this->link = $link;
        $this->estateRequestId = 0;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [$this->description, $this->link];
    }
}
