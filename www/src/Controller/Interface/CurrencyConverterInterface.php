<?php

namespace App\Controller\Interface;

use App\Model\Currency;

interface CurrencyConverterInterface
{
    /**
     * Returns an amount of Money converted into diverent Currencys
     *
     * @return string JSON
     */
    public function convert(float $amount, Currency $currency): string;
}
