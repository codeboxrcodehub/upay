<?php

namespace Codeboxr\Upay\Managers;

use Codeboxr\Upay\Exception\UpayException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class BaseApi
{
    /**
     * @var string
     */
    protected $token = "";

    /**
     * @var string
     */
    protected $baseUrl = "";

    public function __construct()
    {
        $this->baseUrl = config('upay.sandbox') == true ? "https://uat-pg.upay.systems/" : "https://pg.upaysystem.com/";
    }

    /**
     * Set headers
     *
     * @return string[]
     * @throws UpayException
     */
    protected function headers()
    {
        return [
            "Authorization" => "UPAY {$this->getToken()}",
            "Accept"        => "application/json"
        ];
    }

    /**
     * Token generate
     *
     * @return mixed|null
     * @throws UpayException
     */
    protected function getToken()
    {
        if (empty($this->token)) {
            $response = $this->request()
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

    /**
     * request
     *
     * @return PendingRequest
     */
    protected function request()
    {
        $request = Http::acceptJson();
        if (config('upay.sandbox') != true) {
            $request->withOptions([
                'curl' => [CURLOPT_INTERFACE => config("upay.server_ip"), CURLOPT_IPRESOLVE => 1],
            ]);
        }
        return $request;
    }
}
