<?php

namespace Barstec\Paypal;

use Illuminate\Support\Facades\Route;

class Payload
{
    private string $businessEmail;
    private ?string $itemName;
    private ?float $amount;
    private string $currencyCode;
    private string $returnUrl;
    private string $returnCancelUrl;
    private int $noShipping = 1;
    private bool $noNote = true;
    private float $tax = 0;
    private float $shippingCost = 0;
    private array $params = [];

    public function __construct()
    {
        $this->setCurrencyCode(config('paypal.default_currency'));
        if (Route::has(config('paypal.default_return_route'))) {
            $this->setReturnUrl(route(config('paypal.default_return_route')));
        }

        if (Route::has(config('paypal.default_negative_return_route'))) {
            $this->setReturnCancelUrl(route(config('paypal.default_negative_return_route')));
        }
        $this->setBusinessEmail(config('paypal.paypal_email'));
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getBusinessEmail(): string
    {
        return $this->businessEmail;
    }

    public function getItemName(): ?string
    {
        return $this->itemName;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function getNoShipping(): int
    {
        return $this->noShipping;
    }

    public function getNoNote(): bool
    {
        return $this->noNote;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function getReturnUrl(): string
    {
        return $this->returnUrl ?? '';
    }

    public function getReturnCancelUrl(): string
    {
        return $this->returnCancelUrl ?? '';
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function getShippingCost(): float
    {
        return $this->shippingCost;
    }

    public function setBusinessEmail(string $businessEmail): void
    {
        $this->businessEmail = $businessEmail;
    }

    public function setItemName(?string $itemName): void
    {
        $this->itemName = $itemName;
    }

    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }

    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }

    public function setReturnUrl(string $returnUrl): void
    {
        $this->returnUrl = $returnUrl;
    }

    public function setNoShipping(int $noShipping): void
    {
        $this->noShipping = $noShipping;
    }

    public function setNoNote(bool $noNote): void
    {
        $this->noNote = $noNote;
    }

    public function setReturnCancelUrl(string $returnCancelUrl): void
    {
        $this->returnCancelUrl = $returnCancelUrl;
    }

    public function setTax(float $tax): void
    {
        $this->tax = $tax;
    }

    public function setShippingCost(float $shippingCost): void
    {
        $this->shippingCost = $shippingCost;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }
}
