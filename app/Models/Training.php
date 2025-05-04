<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_id',
        'title',
        'category',//json{[TWGs]}
        'description',
        'draft',//status; null inactive, false active, true draft
        'start_date',
        'end_date',
        'location',
    ];
}
