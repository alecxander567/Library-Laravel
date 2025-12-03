<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PaymentEnum;

class Payment extends Model
{
    protected $fillable = [
        'borrower_id',
        'payment_type',
        'amount',
    ];

    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }

    public function getPaymentTypeEnum(): PaymentEnum
    {
        return PaymentEnum::from($this->amount);
    }
}
