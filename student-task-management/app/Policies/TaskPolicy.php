<?php

namespace App\Policies;

use App\Models\User;

class TaskPolicy
{
    public function create(User $user): bool {
        return $user->isTeacher();
    }
    public function approve(User $user): bool {
        return $user->isHeadmaster();
    }
    public function view(User $user, Task $task): bool {
        return $user->isHeadmaster() ||
               ($user->isTeacher() && $task->teacher_id === $user->id) ||
               ($user->isStudent() && $task->approved_at !== null && $task->student->user_id === $user->id);
    }
}
