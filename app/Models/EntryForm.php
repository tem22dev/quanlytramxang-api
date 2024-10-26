<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryForm extends Model
{
    use HasFactory;

    protected $table = 'entry_forms';

    protected $fillable = [
        'id',
        'gas_station_id',
        'total_price',
        'created_at',
    ];

    public function detailEntryForms() {
        return $this->hasMany(DetailEntryForm::class, 'entry_form_id', 'id');
    }

    public function gasStation() {
        return $this->belongsTo(GasStation::class, 'gas_station_id');
    }
}
