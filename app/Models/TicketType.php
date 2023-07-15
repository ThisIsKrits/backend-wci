<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketType extends Model
{
    use HasFactory;

    protected $table = "ticket_price_types";

    protected $fillable = [
        "adult_id", "normal_price", "promo_price", "travel_package_id"
    ];

    public function TravelPackage() :BelongsTo
    {
        return $this->belongsTo(TravelPackage::class, "travel_package_id", "id");
    }

    public function adult() :BelongsTo
    {
        return $this->belongsTo(Adult::class, "adult_id", "id");
    }
}
