<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BridgePoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'coordinates',
        'bridge_id',
        'type_id',
    ];

    public function bridge()
    {
        return $this->belongsTo(Bridge::class);
    }
}
