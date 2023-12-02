<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegrationField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'integration_id',
        'str',
    ];

    public function integration()
    {
        return $this->belongsTo(Integration::class);
    }

    public function values()
    {
        return $this->hasMany(IntegrationFieldValue::class);
    }
}
