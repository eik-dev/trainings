<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class training extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category',//json{[TWGs]}
        'description',
        'draft',//status; null inactive, false active, true draft
        'rating',
        'reviews',
        'trainers',//json{[names]}
    ];
}
