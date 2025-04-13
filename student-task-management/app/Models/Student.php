<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'teacher_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
