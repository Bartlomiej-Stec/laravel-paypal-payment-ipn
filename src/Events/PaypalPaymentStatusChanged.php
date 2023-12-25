<?php

namespace Barstec\Paypal\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaypalPaymentStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public string $transactionId;
    public string $status;
    public array $paymentData;
    /**
     * Create a new event instance.
     */
    public function __construct(string $transactionId, string $status, array $paymentData)
    {
        $this->transactionId = $transactionId;
        $this->status = $status;
        $this->paymentData = $paymentData;
    }
}
