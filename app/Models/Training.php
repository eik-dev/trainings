<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function pricing(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function moduleMedia(): HasMany
    {
        return $this->hasMany(ModuleMedia::class);
    }
}
