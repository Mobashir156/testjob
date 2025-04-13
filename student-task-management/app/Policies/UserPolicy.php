<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function createTeacher(User $user): bool {
        return $user->isHeadmaster();
    }

    public function viewAnyStudent(User $user): bool {
        return $user->isHeadmaster() || $user->isTeacher();
    }
    
    public function createStudent(User $user): bool {
        return $user->isTeacher();
    }
}
