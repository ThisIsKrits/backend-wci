<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ImageTravel extends Model
{
    use HasFactory;

    protected $table = "image_travels";

    protected $fillable = [
        "travel_destination_id", "image"
    ];

    public function getImage() :BelongsTo
    {
        return $this->BelongsTo(TravelDestination::class);
    }
}
