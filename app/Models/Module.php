<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'trainer_id',
        'title',
        'description',
        'type',
        'url',
        'status',
        'time',
    ];
}
