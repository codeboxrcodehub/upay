<?php

namespace Codeboxr\Upay\Managers;

use Codeboxr\Upay\Exception\UpayException;
use Illuminate\Support\Facades\Http;

class BaseApi
{
    protected $token = "";

    protected $baseUrl = "";

    public function __construct()
    {
        $this->baseUrl = config('upay.sandbox') == true ? "https://uat-pg.upay.systems/" : "";
    }

    protected function headers()
    {
        return [
            "Authorization" => "UPAY {$this->getToken()}",
            "Accept"        => "application/json"
        ];
    }

    protected function getToken()
    {
        if (empty($this->token)) {
            $response = Http::acceptJson()
                ->post($this->baseUrl . "payment/merchant-auth/", [
                    "merchant_id"  => config("upay.merchant_id"),
                    "merchant_key" => config("upay.merchant_key"),
                ]);

            $result = json_decode($response->body());
            if ($response->failed()) {
                throw new UpayException($result->message, $response->status());
            }
            $this->token = optional($result->data)->token;
        }

        return $this->token;
    }
}
