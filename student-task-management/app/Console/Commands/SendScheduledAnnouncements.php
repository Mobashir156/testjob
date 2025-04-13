<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendScheduledAnnouncements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-announcements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $announcements = Announcement::where('scheduled_at', '<=', now())
            ->where('is_sent', false)
            ->get();

        foreach ($announcements as $announcement) {
            $students = User::where('role', 'student')->get();

            Notification::send($students, new NewAnnouncementNotification($announcement));

            $announcement->update(['is_sent' => true]);
        }

        $this->info('Sent '.$announcements->count().' announcements.');
    }
}
