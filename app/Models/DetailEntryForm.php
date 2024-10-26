<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEntryForm extends Model
{
    use HasFactory;

    protected $table = 'detail_entry_forms';

    protected $fillable = [
        'id',
        'entry_form_id',
        'fuel_id',
        'quantity',
        'price',
        'created_at'
    ];

    public function invoice() {
        return $this->belongsTo(EntryForm::class, 'entry_form_id');
    }

    public function fuel() {
        return $this->belongsTo(Fuel::class, 'fuel_id');
    }
}
