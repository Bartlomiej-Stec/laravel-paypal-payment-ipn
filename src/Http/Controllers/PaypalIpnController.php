<?php

namespace Barstec\Paypal\Http\Controllers;

use Barstec\Paypal\PaypalIpn;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Barstec\Paypal\Events\PaypalPaymentCompleted;
use Barstec\Paypal\Http\Requests\PaypalIpnRequest;
use Barstec\Paypal\Events\PaypalPaymentStatusChanged;

class PaypalIpnController extends Controller
{
    public function handle(PaypalIpnRequest $request): Response
    {
        $paypalIpn = new PaypalIpn($request->all());
        if (!$paypalIpn->verify()) {
            return response('', 200);
        }

        $paymentData = $paypalIpn->updateTransaction();
        if ($paypalIpn->isPaymentCompleted()) {
            event(new PaypalPaymentCompleted($paypalIpn->getTransactionId(), $paymentData));
        } else if ($paypalIpn->statusChanged()) {
            event(new PaypalPaymentStatusChanged($paypalIpn->getTransactionId(), $paypalIpn->getPaymentStatus(), $paymentData));
        }
        return response('', 200);
    }
}
