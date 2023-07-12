<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InfoTravel extends Model
{
    use HasFactory;

    protected $table = "info_travels";

    protected $fillable = [
        "travel_destination_id", "content"
    ];

    public function TravelDestination() : BelongsTo
    {
        return $this->belongsTo(TravelDestination::class);
    }
}
