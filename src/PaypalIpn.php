<?php

namespace Barstec\Paypal;

use Illuminate\Support\Facades\Http;
use Barstec\Paypal\Http\Models\Transaction;
use Barstec\Paypal\Exceptions\PaypalException;

class PaypalIpn extends Paypal
{
    const NOTIFY_VALIDATE = "_notify-validate";
    const VERIFIED = "VERIFIED";
    const COMPLETED_STATUS = "Completed";
    private array $data;
    private Transaction $transaction;

    protected function getUri(): string
    {
        return $this->isProduction() ? config('paypal.production_ipn_url') : config('paypal.testing_ipn_url');
    }

    protected function verifyBasicPaymentData(): bool
    {
        if (
            $this->data['mc_gross'] != $this->transaction->amount ||
            $this->data['tax'] != $this->transaction->tax ||
            $this->data['shipping'] != $this->transaction->shipping ||
            $this->data['mc_currency'] != $this->transaction->currency_code
        )
            return false;
        return true;
    }

    public function getPaymentStatus(): string
    {
        return $this->data['payment_status'];
    }

    public function getTransactionId(): string
    {
        return $this->transaction->id;
    }

    public function isPaymentCompleted(): bool
    {
        return $this->getPaymentStatus() == self::COMPLETED_STATUS;
    }

    public function statusChanged(): bool
    {
        return $this->transaction->id != $this->getPaymentStatus();
    }

    public function verify(): bool
    {
        if (!$this->verifyBasicPaymentData())
            return false;
        if (!config('paypal.ipn_response_verification_enabled'))
            return true;
        $this->data['cmd'] = self::NOTIFY_VALIDATE;
        $response = Http::withHeaders([
            'User-Agent' => 'PHP-IPN-Verification-Script',
            'Connection' => 'Close',
        ])->asForm()->post($this->getUri(), $this->data);

        $statusCode = $response->status();

        if ($statusCode !== 200) {
            throw new PaypalException("PayPal responded with http code $statusCode and content: " . $response->body());
        }

        $res = $response->body();
        return $res === self::VERIFIED;
    }

    public function extractColumns(): array
    {
        $result = [];
        $columns = array_merge(config('paypal.personal_data_columns'), config('paypal.additional_columns'));
        foreach ($columns as $column) {
            if (isset($this->data[$column])) {
                $result[$column] = $this->data[$column];
            }
        }
        $result['status'] = $this->data['payment_status'];
        return $result;
    }

    public function updateTransaction(): array
    {
        if ($this->statusChanged()) {
            $columns = $this->extractColumns();
            $this->transaction->update($columns);
        }
        return $this->data;
    }

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->transaction = Transaction::where('id', $this->data['custom'])->first();
    }
}