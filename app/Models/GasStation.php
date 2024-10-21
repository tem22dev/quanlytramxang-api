<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasStation extends Model
{
    use HasFactory;

    protected $table = 'gas_stations';

    protected $fillable = [
        'id',
        'user_id',
        'name_station',
        'lng',
        'lat',
        'image',
        'address',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class, 'gas_station_id', 'id');
    }
}
