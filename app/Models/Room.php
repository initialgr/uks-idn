<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'is_active',
    ];

    public function record()
    {
        return $this->belongsToMany(Record::class);
    }
}
