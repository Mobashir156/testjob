<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['task_id', 'notes', 'file_path', 'feedback', 'feedback_by'];

    public function task(): BelongsTo { return $this->belongsTo(Task::class); }
    public function feedbackProvider(): BelongsTo { return $this->belongsTo(User::class, 'feedback_by'); }
}
