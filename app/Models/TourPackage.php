<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TourPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'duration','destination_id', 'type_tour_id', 'price',
        'promo_price', 'desc'
    ];


    public function destination() :BelongsTo
    {
        return $this->belongsTo(DestinationPackage::class, 'destination_id', 'id');
    }

    public function typeTour() :BelongsTo
    {
        return $this->belongsTo(TypeTour::class, 'type_tour_id', 'id');
    }

    public function getImage() :HasOne
    {
        return $this->hasOne(ImagePackage::class, 'tour_package_id', 'id');
    }

    public function journey() :HasMany
    {
        return $this->hasMany(Journey::class);
    }

    public function hotel() :HasMany
    {
        return $this->hasMany(HotelTour::class);
    }

    public function benefit() :HasMany
    {
        return $this->hasMany(Benefit::class);
    }
}
