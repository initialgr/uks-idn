<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Retrieval extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'record_id',
        'drug_id',
        'quantity',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
