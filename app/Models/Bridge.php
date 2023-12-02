<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bridge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'str',
        'type_id',
    ];

    public function bridgePoints()
    {
        return $this->hasMany(BridgePoint::class);
    }
}
