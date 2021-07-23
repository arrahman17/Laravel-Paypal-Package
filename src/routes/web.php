
<?php


use Illuminate\Support\Facades\Route;
use Netmarket\Paypal\Http\Controllers\PayPalPaymentController;

Route::get('paypal', function (){
   return  view('paypal::paypal');
});

Route::group(['namespace' => 'Netmarket\Paypal\Http\Controller'], function(){
    Route::get('paypal/checkout/{event}',  [PayPalPaymentController::class, 'getExpressCheckout'])->name('paypal.checkout');
    Route::get('paypal/checkout-success/{event}', [PayPalPaymentController::class, 'getExpressCheckoutSuccess'])->name('paypal.success');
    Route::get('paypal/checkout-cancel', [PayPalPaymentController::class, 'cancelPage'])->name('paypal.cancel');
});


