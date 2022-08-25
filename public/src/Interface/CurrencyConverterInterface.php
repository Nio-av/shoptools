<?php

use App\Model\Currency;

interface CurrencyConverterInterface
{
    public function convert(float $amount, Currency $currency): string;
}
