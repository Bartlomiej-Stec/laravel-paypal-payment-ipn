<?php

namespace Barstec\Paypal\Events;

use Barstec\Paypal\Payload;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaypalTransactionCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $transactionId;
    public Payload $payload;
    /**
     * Create a new event instance.
     */
    public function __construct(string $transactionId, Payload $payload)
    {
        $this->transactionId = $transactionId;
        $this->payload = $payload;
    }
}
