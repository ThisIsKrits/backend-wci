<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ImagePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_package_id', 'image'
    ];

    // relation
    public function tourPackage() :BelongsTo
    {
        return $this->belongsTo(TourPackage::class, 'tour_package_id', 'id');
    }
}
