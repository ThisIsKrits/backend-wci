<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PassportNote extends Model
{
    use HasFactory;

    protected $fillable = [
        "passport_id", "note"
    ];

    public function Passport() : BelongsTo
    {
        return $this->belongsTo(Passport::class);
    }
}
