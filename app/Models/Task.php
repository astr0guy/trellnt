<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'title',
        'workspace_id',
        'description',
        'task_colour',
        'status',
        'status_colour',
        'deadline',
        'category_id',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
    public function workspace(): BelongsTo {
        return $this->belongsTo(Workspace::class);
    }
    public function participant_badge(): HasMany {
        return $this->hasMany(ParticipantBadge::class);
    }

}
