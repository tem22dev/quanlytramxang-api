<?php

namespace App\Services\Api\V1;

use App\Http\Resources\InvoiceResource;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceService
{
    public function getList()
    {
        $invoices = Invoice::all();

        return InvoiceResource::collection($invoices);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $invoice = Invoice::create([
                'gas_station_id' => $request->gas_station_id,
                'staff_id' => $request->staff_id,
                'total_price' => 0
            ]);

            $totalPrice = 0;

            foreach ($request->detail_invoice as $detail) {
                $detailInvoice = DetailInvoice::create([
                    'invoice_id' => $invoice->id,
                    'fuel_id' => $detail['fuel_id'],
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price'],
                ]);

                $totalPrice += $detailInvoice->price * $detailInvoice->quantity;
            }

            $invoice->total_price = $totalPrice;
            $invoice->save();

            return new InvoiceResource($invoice);
        });
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return $invoice;
        }

        return new InvoiceResource($invoice);
    }

    public function countData()
    {
        return [
            'countInvoice' => Invoice::count(),
        ];
    }
}
