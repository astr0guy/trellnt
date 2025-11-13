<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Workspace extends Model
{


    protected $fillable = [
        'title',
        'user_id',
    ];

    protected $hidden = [
        'workspace_id',
    ];

    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
    public function category(): HasMany {
        return $this->hasMany(Category::class);
    }
    public function task(): HasMany {
        return $this->hasMany(Task::class);
    }

}
