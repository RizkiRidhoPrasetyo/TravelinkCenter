<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'name',
        'email',
        'phone',
        'date',
        'notes',
        'status', // add status field
    ];

    // protected static function booted()
    // {
    //     static::deleted(function ($booking) {
    //         $package = \App\Models\TravelinkPackage::find($booking->package_id);
    //         if ($package) {
    //             $package->increment('max_quota');
    //         }
    //     });
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(TravelinkPackage::class, 'package_id');
    }
}
