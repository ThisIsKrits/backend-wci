<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TravelDestination extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "open", "close","type_ticket",
        "destination_id", "desc", "type_tour_id"
    ];

    public function destination() :BelongsTo
    {
        return $this->belongsTo(DestinationPackage::class);
    }

    public function getImage() :HasOne
    {
        return $this->hasOne(ImageTravel::class);
    }

    public function travelPackage() :HasOne
    {
        return $this->hasOne(TravelPackage::class);
    }

    public function infoTravel() :HasOne
    {
        return $this->hasOne(InfoTravel::class);
    }

    public function typeTour() :BelongsTo
    {
        return $this->belongsTo(TypeTour::class);
    }
}
