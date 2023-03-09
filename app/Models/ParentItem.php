<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParentItem extends Model
{
    use HasFactory;

    /**
     * Has many ChildItems
     */
    public function childItems(): HasMany
    {
        return $this->hasMany(ChildItem::class);
    }
}
