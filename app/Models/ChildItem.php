<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChildItem extends Model
{
    use HasFactory;

    /**
     * Belongs to a ParentItem
     */
    public function parentItem(): BelongsTo
    {
        return $this->belongsTo(ParentItem::class);
    }
}
