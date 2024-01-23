<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_id',
        'user_id',
        'stock',
    ];

    public function drug()
    {
        return $this->belongsToMany(Drug::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
