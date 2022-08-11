<?php

namespace Codeboxr\Upay\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static createPayment($amount, $invoiceId, $txnId, $date)
 * @method static executePayment($amount, $invoiceId, $txnId, $date)
 * @method static queryPayment(string $txnId)
 * @method static getMultiStatus(array $txnIds)
 */
class Payment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'payment';
    }
}
