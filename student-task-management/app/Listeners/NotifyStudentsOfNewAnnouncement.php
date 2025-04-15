<?php

namespace App\Listeners;

use App\Events\AnnouncementCreated;
use App\Models\User;
use App\Notifications\NewAnnouncementNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyStudentsOfNewAnnouncement implements ShouldQueue
{
    public function handle(AnnouncementCreated $event)
    {
        $announcement = $event->announcement;

        // Send to all students
        User::where('role', 'student')->chunk(100, function ($students) use ($announcement) {
            foreach ($students as $student) {
                $student->notify(new NewAnnouncementNotification($announcement));
            }
        });
    }
}
