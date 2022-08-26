<?php

namespace App\View;

use App\Controller\CurrencyConverterService;
use App\Model\Currency;

class CurrencyConverterView
{
    /**
     * Returns dummy data
     *
     * @param string $type Json OR Xml OR Csv
     */
    public function renderAction(float $amount): string
    {
        $Eur = new Currency('Eur');

        $converterService = new CurrencyConverterService();
        $convertedValues = $converterService->convert($amount, $Eur);

        return $convertedValues;
    }
}
