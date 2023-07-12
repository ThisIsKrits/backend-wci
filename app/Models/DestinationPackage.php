<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DestinationPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'city', 'country'
    ];

    public function destination() :HasOne
    {
        return $this->hasOne(TourPackage::class, 'destination_id', 'id');
    }
}
