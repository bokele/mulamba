<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fiilable = [
        'ref_number', 'payment_id', 'owrn_id', 'customer_id', 'vat',
        'total_amount_payable', 'discount_amount', 'net_amount_payable',
        'platform_amount', 'total_amount_pay', 'invoice_for'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owrn_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}
