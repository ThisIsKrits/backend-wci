<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisaRegulation extends Model
{
    use HasFactory;

    protected $fillable = [
        "content" , "visa_id"
    ];

    public function visa() :BelongsTo
    {
        return $this->belongsTo(Visa::class);
    }
}
