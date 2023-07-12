<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaxHotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'pax', 'price'
    ];

    public function hotel() : BelongsTo
    {
        return $this->belongsTo(HotelTour::class);
    }
}
