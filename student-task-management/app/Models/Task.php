<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = ['teacher_id', 'student_id', 'title', 'description', 'approved_at', 'approved_by'];
    
    protected $casts = [
       'approved_at' => 'date',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function submission()
    {
        return $this->hasOne(Submission::class);
    }
}
