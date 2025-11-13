<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ParticipantBadge extends Model
{
        protected $hidden = [
        'user_id',
        'task_id',
    ];
        public function user(): BelongsTo {
        return $this->belongsTo(User::class);
}
    public function task(): BelongsTo {
        return $this->belongsTo(Workspace::class);
    }

}

