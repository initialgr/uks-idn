<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'dose',
        'unit',
        'stok',
        'satuan',
    ];

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
