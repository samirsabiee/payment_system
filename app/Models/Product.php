<?php

namespace App\Models;

use App\Support\Discount\DiscountCalculator;
use App\Support\Discount\DiscountManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    public function hasStock($quantity): bool
    {
        return $this->stock >= $quantity;
    }

    public function decrementStock(int $count)
    {
        return $this->decrement('stock', $count);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceAttribute($price)
    {
        $coupons = $this->category->validCoupons;
        if ($coupons->isNotEmpty()) {
            return resolve(DiscountCalculator::class)->discountedPrice($coupons->first(), $price);
        }
        return $price;
    }
}
