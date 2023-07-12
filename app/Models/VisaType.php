<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisaType extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "visa_id"
    ];

    public function visa() :BelongsTo
    {
        return $this->belongsTo(Visa::class);
    }
}
