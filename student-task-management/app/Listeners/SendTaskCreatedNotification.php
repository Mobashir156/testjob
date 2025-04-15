<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Mail\TaskApprovalNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendTaskCreatedNotification
{
    public function handle(TaskCreated $event)
    {
        $task = $event->task;

        // Notify the headmaster
        $headmaster = User::where('role', 'headmaster')->first();
        if ($headmaster) {
            Mail::to($headmaster->email)->send(new TaskApprovalNotification($task));
        }
    }
}
