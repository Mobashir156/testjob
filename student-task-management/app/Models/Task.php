<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = ['teacher_id', 'student_id', 'title', 'description', 'approved_at', 'approved_by'];

    public function teacher(): BelongsTo { return $this->belongsTo(User::class, 'teacher_id'); }
    public function student(): BelongsTo { return $this->belongsTo(Student::class); }
    public function approver(): BelongsTo { return $this->belongsTo(User::class, 'approved_by'); }
    public function submission(): HasOne { return $this->hasOne(Submission::class); }
}
