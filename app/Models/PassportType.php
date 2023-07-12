<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PassportType extends Model
{
    use HasFactory;

    protected $fillable = [
        "passport_id", "content"
    ];

    public function Passport() :BelongsTo
    {
        return $this->belongsTo(Passport::class);
    }
}
