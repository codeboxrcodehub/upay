<p align="center" >
  <img src="https://www.upaybd.com/images/Upay-Logo.jpg">
</p>

 <h1 align="center">uPay BD Payment Gateway</h1>
<p align="center" >
<img src="https://img.shields.io/packagist/dt/codeboxr/upay">
<img src="https://img.shields.io/packagist/stars/codeboxr/upay">
</p>
## Requirements

- PHP >=7.2
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
"sandbox"                => env("UPAY_SANDBOX", false), // for production use true
"merchant_id"            => env("UPAY_MERCHANT_ID", ""),
"merchant_key"           => env("UPAY_MERCHANT_KEY", ""),
"merchant_code"          => env("UPAY_MERCHANT_CODE", ""),
"merchant_name"          => env("UPAY_MERCHANT_NAME", ""),
"merchant_mobile"        => env("UPAY_MERCHANT_MOBILE", ""),
"merchant_city"          => env("UPAY_MERCHANT_CITY", ""),
"merchant_category_code" => env("UPAY_CATEGORY_CODE", "9399"),
"redirect_url"           => env("UPAY_CALLBACK_URL", "")
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

## Contributing

Contributions to the uPay package are welcome. Please note the following guidelines before submitting your pull request.

- Follow [PSR-4](http://www.php-fig.org/psr/psr-4/) coding standards.
- Read uPay API documentations first

## License

uPay package is licensed under the [MIT License](http://opensource.org/licenses/MIT).

Copyright 2022 [Codeboxr](https://codeboxr.com)
