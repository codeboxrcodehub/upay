<p align="center" >
  <img src="https://www.upaybd.com/images/Upay-Logo.jpg">
</p>

 <h1 align="center">uPay BD Payment Gateway</h1>
<p align="center" >
<img src="https://img.shields.io/packagist/dt/codeboxr/upay">
<img src="https://img.shields.io/packagist/stars/codeboxr/upay">
</p>

## Features

1. [Create Payment/Take to Payment Page](https://github.com/codeboxrcodehub/upay#1-create-payment)
2. [Query Payment/Payment Details](https://github.com/codeboxrcodehub/upay#2-query-payment)

## Requirements

- PHP >=7.4
- Laravel >= 6

## Installation

```bash
composer require codeboxr/upay
```

### vendor publish (config)

```bash
php artisan vendor:publish --provider="Codeboxr\Upay\UpayServiceProvider"
```

After publish config file setup your credential. you can see this in your config directory upay.php file

```
"sandbox"                => env("UPAY_SANDBOX", false), // for sandbox use true
"server_ip"              => env("UPAY_SERVER_IP", ""),
"merchant_id"            => env("UPAY_MERCHANT_ID", ""),
"merchant_key"           => env("UPAY_MERCHANT_KEY", ""),
"merchant_code"          => env("UPAY_MERCHANT_CODE", ""),
"merchant_name"          => env("UPAY_MERCHANT_NAME", ""),
"merchant_mobile"        => env("UPAY_MERCHANT_MOBILE", ""),
"merchant_city"          => env("UPAY_MERCHANT_CITY", ""),
"merchant_category_code" => env("UPAY_CATEGORY_CODE", ""),
"redirect_url"           => env("UPAY_CALLBACK_URL", "")
```

### Set .env configuration

```
UPAY_SANDBOX=true // for production use false
UPAY_SERVER_IP="" // uPay only support IPV4 for production server don't needed sandbox
UPAY_MERCHANT_ID=""
UPAY_MERCHANT_KEY=""
UPAY_MERCHANT_CODE=""
UPAY_MERCHANT_NAME=""
UPAY_MERCHANT_MOBILE=""
UPAY_MERCHANT_CITY=""
UPAY_CATEGORY_CODE=""
UPAY_CALLBACK_URL=""
```

## Usage

### 1. Create Payment

```
use Codeboxr\Upay\Facade\Payment;

return Payment::executePayment($amount, $invoiceId, $txnId, $date);

```

### Example

```
return Payment::executePayment(10, 'CBX10101', '10127373', '2022-08-26');
```

### 2. Query Payment

```
use Codeboxr\Upay\Facade\Payment;

Payment::queryPayment($invoiceId); // Invoice ID 
```

<span style="color: #70b7cd">Note: uPay only support IPV4 for production server</span>

## Contributing

Contributions to the uPay package are welcome. Please note the following guidelines before submitting your pull request.

- Follow [PSR-4](http://www.php-fig.org/psr/psr-4/) coding standards.
- Read uPay API documentations first.Please contact with uPay for their api documentation and sandbox access.

## License

uPay package is licensed under the [MIT License](http://opensource.org/licenses/MIT).

Copyright 2022 [Codeboxr](https://codeboxr.com) We are not not affiliated with uPay and don't give any guarantee.
