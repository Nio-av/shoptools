<?php

// namespace Tests;

declare(strict_types=1);

use App\Controller\CurrencyConverterService;
use App\Controller\Rest\CurrencyApi;
use App\Model\Currency;
use PHPUnit\Framework\TestCase;

final class ConverterTest extends TestCase
{
    /**
     * Test for Exampel Currency
     */
    public function testCurrencyConverterCalculation(): void
    {
        $converterService = new CurrencyConverterService();
        $currencyCode = 'eur';
        $Currency = new Currency($currencyCode);
        $convertedValues = $converterService->convert(1, $Currency);
        // $convertedValues = json_decode($convertedValues);


        $Api = new CurrencyApi();
        $exchangeRates = $Api->getExchangeRates($currencyCode);
        $exchangeRates = json_encode($exchangeRates);



        $this->assertEquals(
            $convertedValues,
            $exchangeRates,
        );
    }
}
