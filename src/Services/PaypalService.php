<?php

namespace Netmarket\Paypal\Services;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class PaypalService
{
    private $client;

    function __construct()
    {
        $environment = new SandboxEnvironment(env('PAYPAL_SANDBOX_CLIENT_ID'), env('PAYPAL_SANDBOX_CLIENT_SECRET'));
        $this->client = new PayPalHttpClient($environment);
    }

    public function createOrder($orderId)
    {

        $request = new OrdersCreateRequest();
        //dd($request);
        $request->headers["prefer"] = "return=representation";
      //  $request->body = $this->checkoutData($orderId);
         $request->body = $this->simpleCheckoutData($orderId);
          //dd($this->client->execute($request));
        return $this->client->execute($request);
    }

    public function captureOrder($paypalOrderId)
    {
        $request = new OrdersCaptureRequest($paypalOrderId);

        //dd($request);
       // dd($this->client->execute($request));
        return $this->client->execute($request);
    }


    private function simpleCheckoutData($orderId)
    {

        return [
                "intent" => "CAPTURE",
                "purchase_units" => [[
                    "reference_id" => 'webmall_'. uniqid(),
                    "amount" => [
                        "value" => 5,
                        "currency_code" => "Eur"
                    ]
                ]],
                "application_context" => [
                    "Content-Type" =>"application/json",
                    "Authorization" =>" Bearer Access-Token",
                    "cancel_url" => route('paypal.cancel'),
                    "return_url" => route('paypal.success', $orderId)
                ]
            ];



    }





}
