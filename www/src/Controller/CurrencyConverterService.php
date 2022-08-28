<?php

namespace App\Controller;

use App\Model\Currency;
use App\Controller\Interface\CurrencyConverterInterface;
use App\Controller\Rest\CurrencyApi;

class CurrencyConverterService implements CurrencyConverterInterface
{
    public function convert(float $amount, Currency $currency): string
    {
        $Api = new CurrencyApi();
        $exchangeRates = $Api->getExchangeRates($currency->getCurrencyCode());

        $convertedValues = [];
        if (is_array($exchangeRates)) {
            foreach ($exchangeRates as $currency => $exchangeRate) {
                $convertedValues[$currency] = ((1000 * $amount) * (1000 * (float) $exchangeRate) / 1000000);
            }
            if (count($exchangeRates) < 1) {
                // TODO: Log Error
            }
        } else {
            // TODO: Log Error
        }

        return json_encode($convertedValues);
    }
}
