<?php

namespace Barstec\Paypal;

use Illuminate\Support\Facades\Facade;

final class PaypalFacade extends Facade
{
    /**
     * Return Laravel Framework facade accessor name.
     * 
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'paypal';
    }
}