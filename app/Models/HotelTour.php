<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelTour extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_package_id', 'name'
    ];

    public function package() :BelongsTo
    {
        return $this->belongsTo(TourPackage::class, 'tour_package_id', 'id');
    }

    public function price() :HasMany
    {
        return $this->hasMany(PaxHotel::class, 'hotel_id', 'id');
    }
}
