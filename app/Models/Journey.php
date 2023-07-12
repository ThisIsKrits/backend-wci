<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Journey extends Model
{
    use HasFactory;

    protected $table = "journies";

    protected $fillable = [
        'tour_package_id', 'day', 'image', 'desc'
    ];

    public function tourPackage() :BelongsTo
    {
        return $this->belongsTo(TourPackage::class, 'tour_package_id', 'id');
    }

    public function obtained() :HasMany
    {
        return $this->hasMany(Obtained::class);
    }
}
