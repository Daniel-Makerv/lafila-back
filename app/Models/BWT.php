<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class BWT extends Model
{
    protected $connection = 'mongodb';

    use HasFactory;
}
