<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['headmaster_id', 'title', 'description', 'original_image_path', 'resized_image_path', 'scheduled_at'];

    public function headmaster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'headmaster_id');
    }
}
