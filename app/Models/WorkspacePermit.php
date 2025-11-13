<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkspacePermit extends Model
{
        protected $hidden = [
        'user_id',
        'workspace_id',
        'permit_level',
    ];
        public function user(): BelongsTo {
        return $this->belongsTo(User::class);
}
    public function workspace(): BelongsTo {
        return $this->belongsTo(Workspace::class);
    }

}

