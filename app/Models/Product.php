<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
    ];

    public function movements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class);
    }

    public function getStockAttribute(): int
    {
        if ($this->relationLoaded('movements')) {
            $entries = $this->movements->where('type', 'entry')->sum('quantity');
            $exits = $this->movements->where('type', 'exit')->sum('quantity');
            return $entries - $exits;
        }

        return $this->attributes['stock'] ?? $this->computeStock();
    }

    private function computeStock(): int
    {
        $entries = $this->movements()->where('type', 'entry')->sum('quantity');
        $exits = $this->movements()->where('type', 'exit')->sum('quantity');
        return $entries - $exits;
    }
}
