<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PassportRegulation extends Model
{
    use HasFactory;

    protected $fillable = [
        "adult_id", "passport_id", "content"
    ];

    public function passport() :BelongsTo
    {
        return $this->belongsTo(Passport::class);
    }

    public function adult() :BelongsTo
    {
        return $this->belongsTo(Adult::class);
    }
}
