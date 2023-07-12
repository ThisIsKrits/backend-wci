<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visa extends Model
{
    use HasFactory;

    protected $table = "visa";

    protected $fillable = [
        "country_id"
    ];

    public function country() :BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function visaType() :HasMany
    {
        return $this->hasMany(VisaType::class);
    }

    public function visaRegulation() :HasMany
    {
        return $this->hasMany(VisaRegulation::class);
    }
}
