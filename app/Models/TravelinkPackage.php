<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelinkPackage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['name', 'region', 'price', 'promo_price', 'hashtag', 'max_quota', 'images', 'category', 'expired_at', 'description'];

    protected $casts = [
        'images' => 'array',
        'expired_at' => 'date',
    ];

    // Define relationships for comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship for ratings
    public function ratings()
    {
        return $this->hasMany(PackageRating::class, 'package_id');
    }

    // Get average rating
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    // Get rating statistics (count per rating value)
    public function ratingStats()
    {
        return $this->ratings()
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating');
    }
}
