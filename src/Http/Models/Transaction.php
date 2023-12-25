<?php

namespace Barstec\Paypal\Http\Models;

use Barstec\Paypal\Payload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'updated_at',
        'created_at',
    ];

    public function getTable(): string
    {
        return $this->table ?: config('paypal.table_name') ?? parent::getTable();
    }

    public function createTransaction(Payload $payload): string
    {
        return $this->create([
            'item' => $payload->getItemName(),
            'amount' => $payload->getAmount(),
            'currency_code' => $payload->getCurrencyCode(),
            'tax' => $payload->getTax(),
            'shipping' => $payload->getShippingCost(),
        ])->id;
    }
}
