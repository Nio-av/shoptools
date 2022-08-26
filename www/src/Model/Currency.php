<?php

namespace App\Model;

use App\Controller\Rest\CurrencyApi;

/**
 * Basic getter for a currency
 */
class Currency
{
    /**
     * Name of currency
     */
    protected string $currencyName;
    /** ISO 4217 */
    protected string $currencyCode;


    /**
     * Symbol of Currency; i.E. €; £
     */
    protected string $currencySymbol;

    /**
     * @var float[]
     */
    protected array $exchangeRates;

    /**
     * @param string $currencyCode ISO 4217
     */
    public function __construct(string $currencyCode)
    {
        $this->currencyCode = strtolower($currencyCode);
        $this->getExchangeRatesFromApi();
    }



    /**
     * @param float[] $exchangeRate associative array; format: [[EUR] => 1, [USD] => 5,]
     * @return void
     */
    public function setExchangeRates(array $exchangeRates): void
    {
        $this->exchangeRates = $exchangeRates;
    }

    /**
     * @return float[] $exchangeRate associative array; format: [[EUR] => 1, [USD] => 5,]
     */
    public function getExchangeRates(): array
    {
        return $this->exchangeRates;
    }

    /**
     * Load Exchange Rate from API & save to object
     */
    private function getExchangeRatesFromApi(): void
    {
        $Api = new CurrencyApi();
        $this->exchangeRates = $Api->getExchangeRates($this->currencyCode);
    }
}
