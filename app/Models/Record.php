<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'school',
        'allergy',
        'status',
        'complaint',
        'ph_inspect',
        'diagnose',
    ];
}
