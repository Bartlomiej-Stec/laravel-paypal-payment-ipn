<?php
use Barstec\Paypal\Http\Controllers\PaypalIpnController;

Route::prefix('api')->group(function () {
    Route::group(['middleware' => ['api']], function () {
        Route::post(config('paypal.notification_route'), [PaypalIpnController::class, 'handle'])
            ->name('paypal.notification');
    });
});
