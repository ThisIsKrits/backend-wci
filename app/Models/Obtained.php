<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Obtained extends Model
{
    use HasFactory;

    protected $fillable = [
        'journey_id', 'name'
    ];

    public function journey() :BelongsTo
    {
        return $this->belongsTo(Journey::class, 'journey_id', 'id');
    }
}
