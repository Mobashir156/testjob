<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'teacher_id','roll_number','class','section'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    public function assignedTasks()
    {
        return $this->hasMany(Task::class);
    }
}
