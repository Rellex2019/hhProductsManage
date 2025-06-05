<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2) . ' ₽';
    }

    public static function createNew(array $data): self
    {
        return self::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
        ]);
    }

    public function updateInfo(array $data): bool
    {
        return $this->update([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
        ]);
    }
}
