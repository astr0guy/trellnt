<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'workspace_id',
        'title',
    ];

    public function workspace(): BelongsTo
{
    return $this->belongsTo(Workspace::class);
}

}
