<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Passport extends Model
{
    use HasFactory;

    protected $fillable = [
        "country_id"
    ];

    public function Country() :BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function typePassport() :HasMany
    {
        return $this->hasMany(PassportType::class);
    }

    public function regulation() :HasMany
    {
        return $this->hasMany(PassportRegulation::class);
    }

    public function passportNote() :HasMany
    {
        return $this->hasMany(PassportNote::class);
    }
}
