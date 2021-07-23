<?php

namespace Netmarket\Paypal\Http\Controllers;



use Illuminate\Routing\Controller;
use Netmarket\Paypal\Services\PaypalService;

class PayPalPaymentController extends Controller
{
    private $paypalService;
    private $paypal_orderid;

    function __construct(PaypalService $paypalService)
    {

        $this->paypalService = $paypalService;

    }


    public function getExpressCheckout($orderId)
    {

        $response = $this->paypalService->createOrder($orderId);
        if($response->statusCode !== 201) {
            abort(500);
        }
        $this->paypal_orderid = $response->result->id;
        session()->put('paypal-orderID', $this->paypal_orderid);
        // dd($response->result->links);

        foreach ($response->result->links as $link)
        {

            if($link->rel == 'approve')
            {

                return redirect($link->href);
            }
        }

    }


    public function getExpressCheckoutSuccess($order)
    {


        // dd($this->paypalService->captureOrder($this->paypal_orderid));
        $paypal_order_id = session()->get('paypal-orderID');
        $response = $this->paypalService->captureOrder($paypal_order_id);
        // dd($response);
        if ($response->result->status == 'COMPLETED')
        {

            return redirect('/')->with('Success', 'Successful');

        }

        return redirect()->route('/')->withError('Payment UnSuccessful! Something went wrong!');


    }




}
