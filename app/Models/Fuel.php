<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    protected $table = 'fuels';

    protected $fillable = [
        'id',
        'name',
        'type_fuel',
        'price',
        'description',
        'created_at',
    ];
}
