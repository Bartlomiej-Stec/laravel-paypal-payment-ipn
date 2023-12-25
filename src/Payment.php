<?php

namespace Barstec\Paypal;

use Barstec\Paypal\Events\PaypalTransactionCreated;
use Illuminate\Http\RedirectResponse;
use Barstec\Paypal\Http\Models\Transaction;

class Payment extends Paypal
{
    const CMD = "_xclick";
    const BUTTON_TYPE = "services";
    private Payload $payload;
    protected function prepareParams(string $id): array
    {
        $data = [
            'cmd' => self::CMD,
            'button_subtype' => self::BUTTON_TYPE,
            'custom' => $id,
            'business' => $this->payload->getBusinessEmail(),
            'item_name' => $this->payload->getItemName(),
            'amount' => $this->payload->getAmount(),
            'currency_code' => $this->payload->getCurrencyCode(),
            'return' => $this->payload->getReturnUrl(),
            'cancel_url' => $this->payload->getReturnCancelUrl(),
            'tax' => $this->payload->getTax(),
            'shipping' => $this->payload->getShippingCost(),
            'no_shipping' => $this->payload->getNoShipping(),
            'no_note' => intval($this->payload->getNoNote())
        ];
        return array_merge($data, $this->payload->getParams());
    }

    protected function getEndpointUrl(): string
    {
        return $this->isProduction() ? config('paypal.production_transaction_url') : config('paypal.testing_transaction_url');
    }

    public function redirect(): RedirectResponse
    {
        $transaction = new Transaction();
        $id = $transaction->createTransaction($this->payload);
        $params = $this->prepareParams($id);
        $query = http_build_query($params);
        $url = $this->getEndpointUrl();
        event(new PaypalTransactionCreated($id, $this->payload));
        return redirect($url . '?' . $query);
    }

    public function __construct(Payload $payload)
    {
        $this->payload = $payload;
    }
}