<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleMedia extends Model
{
    //
    protected $fillable = [
        'training_id',
        'module_id',
        'url',
    ];
}
