<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Events\StudentCreated;
use App\Listeners\SendStudentCreatedEmails;
use App\Events\TaskCreated;
use App\Listeners\SendTaskCreatedNotification;
use App\Events\AnnouncementCreated;
use App\Listeners\NotifyStudentsOfNewAnnouncement;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     */
    protected $listen = [
        Registered::class => [SendEmailVerificationNotification::class],

        StudentCreated::class => [SendStudentCreatedEmails::class],
        TaskCreated::class => [SendTaskCreatedNotification::class],
        AnnouncementCreated::class => [
        NotifyStudentsOfNewAnnouncement::class,
    ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }
}
