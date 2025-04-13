<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['name', 'email', 'password', 'role', 'phone'];

    public function isHeadmaster(): bool {
        return $this->role === 'headmaster';
    }
    public function isTeacher(): bool { return $this->role === 'teacher'; }
    public function isStudent(): bool { return $this->role === 'student'; }

    // Relationships
    public function students(): HasMany { return $this->hasMany(Student::class, 'teacher_id'); }
    public function myStudents(): HasMany { return $this->hasMany(Student::class, 'user_id'); }
    public function tasks(): HasMany { return $this->hasMany(Task::class, 'teacher_id'); }
    public function assignedTasks(): HasMany { return $this->hasMany(Task::class, 'student_id'); }
    public function announcements(): HasMany { return $this->hasMany(Announcement::class, 'headmaster_id'); }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
