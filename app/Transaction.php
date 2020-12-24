<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'status',   'owner_id', 'invoice_id', 'transaction_type_id', 'ref', 'bank',
        'code', 'amount', 'account_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(User::class, 'invoice_id', 'id');
    }

    public function transactionType()
    {
        return $this->belongsTo(User::class, 'transaction_type_id', 'id');
    }
}
