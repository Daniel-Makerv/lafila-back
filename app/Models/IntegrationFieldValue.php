<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegrationFieldValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'integration_field_id',
    ];

    public function field()
    {
        return $this->belongsTo(IntegrationField::class);
    }
}
