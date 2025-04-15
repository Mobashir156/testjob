<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use App\Mail\StudentWelcomeMail;
use App\Mail\HeadmasterNotificationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendStudentCreatedEmails
{
    public function handle(StudentCreated $event)
    {
        $student = $event->student;
        $user = $student->user;

        // Send welcome email to the student
        Mail::to($user->email)->send(new StudentWelcomeMail($student));

        // Notify headmaster
        $headmaster = User::where('role', 'headmaster')->first();
        if ($headmaster) {
            Mail::to($headmaster->email)->send(new HeadmasterNotificationMail($student));
        }
    }
}
