<?php

return [
    "sandbox"                => env("UPAY_SANDBOX", false),
    "server_ip"              => env("UPAY_SERVER_IP", ""),
    "merchant_id"            => env("UPAY_MERCHANT_ID", ""),
    "merchant_key"           => env("UPAY_MERCHANT_KEY", ""),
    "merchant_code"          => env("UPAY_MERCHANT_CODE", ""),
    "merchant_name"          => env("UPAY_MERCHANT_NAME", ""),
    "merchant_mobile"        => env("UPAY_MERCHANT_MOBILE", ""),
    "merchant_city"          => env("UPAY_MERCHANT_CITY", ""),
    "merchant_category_code" => env("UPAY_CATEGORY_CODE", ""),
    "redirect_url"           => env("UPAY_CALLBACK_URL", "")
];
