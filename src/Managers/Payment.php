<?php

namespace Codeboxr\Upay\Managers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Codeboxr\Upay\Exception\UpayException;
use Illuminate\Contracts\Foundation\Application;

class Payment extends BaseApi
{
    /**
     * Create payment
     *
     * @param string $amount
     * @param string $invoiceId
     * @param string $txnId
     * @param string $date
     *
     * @return JsonResponse
     * @throws UpayException
     */
    public function createPayment($amount, $invoiceId, $txnId, $date)
    {
        $upayResponse = $this->request()
            ->withHeaders($this->headers())
            ->post($this->baseUrl . "payment/merchant-payment-init/", [
                "date"                      => $date,
                "txn_id"                    => $txnId,
                "invoice_id"                => $invoiceId,
                "amount"                    => $amount,
                "merchant_id"               => config('upay.merchant_id'),
                "merchant_name"             => config('upay.merchant_name'),
                "merchant_code"             => config('upay.merchant_code'),
                "merchant_country_code"     => "BD",
                "merchant_city"             => config("upay.merchant_city"),
                "merchant_category_code"    => config("upay.merchant_category_code"),
                "merchant_mobile"           => config("upay.merchant_mobile"),
                "transaction_currency_code" => "BD",
                "redirect_url"              => config("upay.redirect_url"),
            ]);

        $result = json_decode($upayResponse->body());
        if ($upayResponse->failed()) {
            throw new UpayException($result->message, $upayResponse->status());
        }

        return response()->json([
            "code"        => $result->code,
            "session_id"  => optional($result->data)->session_id,
            "txn_id"      => optional($result->data)->txn_id,
            "trx_id"      => optional($result->data)->trx_id,
            "invoice_id"  => optional($result->data)->invoice_id,
            "gateway_url" => optional($result->data)->gateway_url,
        ]);

    }

    /**
     * Redirect payment page
     *
     * @param string $amount
     * @param string $invoiceId
     * @param string $txnId
     * @param string $date
     *
     * @return Application|RedirectResponse|Redirector|void
     * @throws UpayException
     */
    public function executePayment($amount, $invoiceId, $txnId, $date)
    {
        $data = $this->createPayment($amount, $invoiceId, $txnId, $date)->getData();
        return redirect($data->gateway_url);
    }

    /**
     * Single Payment Details
     *
     * @param string $txnId
     *
     * @return JsonResponse
     * @throws UpayException
     */
    public function queryPayment(string $txnId)
    {
        $upayResponse = $this->request()
            ->withHeaders($this->headers())
            ->get($this->baseUrl . "payment/single-payment-status/{$txnId}/");

        $result = json_decode($upayResponse->body());
        if ($upayResponse->failed()) {
            throw new UpayException($result->message, $upayResponse->status());
        }

        return response()->json([
            "code"          => $result->code,
            "session_id"    => optional($result->data)->session_id,
            "txn_id"        => optional($result->data)->txn_id,
            "trx_id"        => optional($result->data)->trx_id,
            "invoice_id"    => optional($result->data)->invoice_id,
            "status"        => optional($result->data)->status,
            "amount"        => optional($result->data)->amount,
            "merchant_name" => optional($result->data)->merchant_name,
            "date"          => optional($result->data)->date,
        ]);
    }

    /**
     * Multiple Payment Status
     *
     * @param array $txnIds
     *
     * @return JsonResponse
     * @throws UpayException
     */
    public function getMultiStatus(array $txnIds)
    {
        $upayResponse = $this->request()
            ->withHeaders($this->headers())
            ->post($this->baseUrl . "payment/bulk-payment-status/", [
                "txn_id_list" => $txnIds
            ]);

        $result = json_decode($upayResponse->body());
        if ($upayResponse->failed()) {
            throw new UpayException($result->message, $upayResponse->status());
        }

        return response()->json($result->data);
    }
}
