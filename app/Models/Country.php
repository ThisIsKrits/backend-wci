<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "code"
    ];

    public function passport() :HasOne
    {
        return $this->hasOne(Passport::class);
    }

    public function visa() :HasOne
    {
        return $this->hasOne(Visa::class);
    }
}
