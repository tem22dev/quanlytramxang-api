<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInvoice extends Model
{
    use HasFactory;

    protected $table = 'detail_invoices';

    protected $fillable = [
        'id',
        'invoice_id',
        'fuel_id',
        'quantity',
        'price',
        'created_at'
    ];

    public function invoice() {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function fuel() {
        return $this->belongsTo(Fuel::class, 'fuel_id');
    }
}
