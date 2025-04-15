<?php

namespace App\Notifications;

use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewAnnouncementNotification extends Notification
{
    use Queueable;

    public $announcement;

    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Announcement')
            ->greeting('Hello!')
            ->line('A new announcement has been published:')
            ->line('**' . $this->announcement->title . '**')
            ->line($this->announcement->description)
            ->action('View Announcements', url('/announcements'))
            ->line('Thank you!');
    }
}
