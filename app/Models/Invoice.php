<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'id',
        'gas_station_id',
        'staff_id',
        'total_price',
        'created_at',
    ];

    public function detailInvoices() {
        return $this->hasMany(DetailInvoice::class, 'invoice_id', 'id');
    }

    public function gasStation() {
        return $this->belongsTo(GasStation::class, 'gas_station_id');
    }

    public function Staff() {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
