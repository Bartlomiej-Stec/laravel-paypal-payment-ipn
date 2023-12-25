<?php

namespace Barstec\Paypal;

abstract class Paypal
{
    public function isProduction(): bool
    {
        return config('paypal.mode') === "prod";
    }

    public function isDev(): bool
    {
        return config('paypal.mode') === "dev";
    }
}