<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'type',
        'price',
    ];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
