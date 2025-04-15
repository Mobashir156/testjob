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

    protected $fillable = ['name', 'email', 'password', 'role', 'phone','permissions'];

    public function isHeadmaster(): bool
    {
        return $this->role === 'headmaster';
    }
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    // Relationships
    public function students()
    {
        return $this->hasMany(Student::class, 'teacher_id');
    }
    public function myStudents()
    {
        return $this->hasMany(Student::class, 'user_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'teacher_id');
    }
    public function assignedTasks()
    {
        return $this->hasMany(Task::class);
    }
    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'headmaster_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

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
            'permissions' => 'array',
        ];
    }

    public function hasPermission($key)
    {
        if ($this->role === 'headmaster') {
            return true;
        }
    
        // Check if the permissions are already an array. If not, decode the JSON string.
        $permissions = is_array($this->permissions) ? $this->permissions : json_decode($this->permissions, true);
    
        if ($permissions === null) {
            // Handle the case where decoding fails
            return false;
        }
    
        $keys = explode('.', $key);
        $current = $permissions;
    
        foreach ($keys as $k) {
            if (!isset($current[$k])) {
                return false;
            }
            $current = $current[$k];
        }
    
        return $current === true; 
    }

}
