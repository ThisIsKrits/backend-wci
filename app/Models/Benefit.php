<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_package_id','content'
    ];

    public function tourPackage() :BelongsTo
    {
        return $this->belongsTo(TourPackage::class, 'tour_package_id', 'id');
    }
}
