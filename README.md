# Laravel Package for Paypal Payment Integration
# Package info

This package is a gateway to the PayPal Payment API( REST-API), in order to use this package from the github repo.

**Framework => Laravel 8 with PHP 7.3**

- I hope Laravel 7 could also be compatible 

# There are some steps to follow:

 **Update the paypal sandbox client key and secret key** 

 - in .env add this along with your paypal credentials:
 - PAYPAL_SANDBOX_CLIENT_ID= 
 - PAYPAL_SANDBOX_CLIENT_SECRET= 

**add this to composer** 
 
 - in require =>  "Netmarket/Paypal": "^1.0.1" 
 - then add this below require
 - "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/arrahman17/Laravel-Paypal-Package"
        }
    ],


**Add in config**

- config->app.php in  'providers' => [ ......
  Netmarket\Paypal\PaypalServiceProvider::class
  ],
  
  
**In Terminal run just** 

- "composer update"

**In vendor**

- vendor->netmarket->paypal->src->Services->PaypalService->function simpleCheckoutData()
- change the amount value from session or through whatever you want
