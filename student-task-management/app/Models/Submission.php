<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['task_id', 'notes', 'file_path', 'feedback', 'feedback_by','feedback_at'];
    
    protected $casts = [
       'feedback_at' => 'date',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function feedbackProvider()
    {
        return $this->belongsTo(User::class, 'feedback_by');
    }
}
