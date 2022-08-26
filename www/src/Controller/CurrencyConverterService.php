<?php

namespace App\Controller;

use App\Model\Currency;
use App\Controller\Interface\CurrencyConverterInterface;

class CurrencyConverterService implements CurrencyConverterInterface
{
    public function convert(float $amount, Currency $currency): string
    {
        $exchangeRates = $currency->getExchangeRates();

        $convertedValues = [];
        if (is_array($exchangeRates)) {
            foreach ($exchangeRates as $currency => $exchangeRate) {
                $convertedValues[$currency] = $amount * (float) $exchangeRate;
            }
        } else {
            // TODO: Log Error
        }

        return json_encode($convertedValues);
    }
}
