<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'product_id',
        'quantity',
        'status',
        'comment'
    ];

    protected $attributes = [
        'status' => 'новый',
        'quantity' => 1,
    ];


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    public function getTotalPriceAttribute(): float
    {
        return $this->product->price * $this->quantity;
    }


    public function getFormattedTotalPriceAttribute(): string
    {
        return number_format($this->total_price, 2) . ' ₽';
    }


    public static function createNew(array $data): self
    {
        return self::create([
            'customer_name' => $data['customer_name'],
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'comment' => $data['comment'] ?? null,
        ]);
    }

    public function markAsCompleted(): bool
    {
        return $this->update(['status' => 'выполнен']);
    }

    public function isNew(): bool
    {
        return $this->status === 'новый';
    }
}
