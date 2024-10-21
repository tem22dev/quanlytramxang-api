<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = [
        'id',
        'gas_station_id',
        'full_name',
        'tel',
        'address',
        'birth_date',
        'position',
        'created_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function gasStation()
    {
        return $this->belongsTo(GasStation::class, 'gas_station_id');
    }
}
