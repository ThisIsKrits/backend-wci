<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TravelPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        "travel_destination_id", "name", "detail_ticket", "info_ticket"
    ];

    public function travelDestination() :BelongsTo
    {
        return $this->belongsTo(TravelDestination::class);
    }

    public function typeTicket() :HasMany
    {
        return $this->hasMany(TicketType::class);
    }
}
