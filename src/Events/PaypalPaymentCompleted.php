<?php

namespace Barstec\Paypal\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaypalPaymentCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $transactionId;
    public array $paymentData;
    /**
     * Create a new event instance.
     */
    public function __construct(string $transactionId, array $paymentData)
    {
        $this->transactionId = $transactionId;
        $this->paymentData = $paymentData;
    }
}
