<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'brand_id',
        'name',
        'description',
        'price',
        'sale_percentage',
        'image',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'is_featured',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'sale_percentage' => 'integer',
        'stock' => 'integer',
    ];

    protected $appends = [
        'sale_price',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function getSalePriceAttribute(): float
    {
        $sale = max(0, min(99, (int) ($this->sale_percentage ?? 0)));

        return round((float) $this->price * (100 - $sale) / 100, 2);
    }

    public function getPrimaryImageAttribute(): ?string
    {
        return collect([
            $this->image_1,
            $this->image_2,
            $this->image_3,
            $this->image_4,
            $this->image,
        ])->firstWhere(fn ($path) => !empty($path));
    }

    public function getGalleryImagesAttribute()
    {
        return collect([
            $this->image_1,
            $this->image_2,
            $this->image_3,
            $this->image_4,
        ])->filter(fn ($path) => !empty($path))->values();
    }
}
