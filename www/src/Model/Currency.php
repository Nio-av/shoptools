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
    protected array $exchangeRate;

    /**
     * @param string $currencyCode ISO 4217
     */
    public function __construct(string $currencyCode)
    {
        $this->currencyCode = strtolower($currencyCode);
        $this->getExchangeRateFromApi();
    }



    /**
     * @param float[] $exchangeRate associative array; format: [[EUR] => 1, [USD] => 5,]
     * @return void
     */
    public function setExchangeRate(array $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @return float[] $exchangeRate associative array; format: [[EUR] => 1, [USD] => 5,]
     */
    public function getExchangeRate(): array
    {
        return $this->exchangeRate;
    }

    /**
     * Load Exchange Rate from API & save to object
     */
    private function getExchangeRateFromApi(): void
    {
        $Api = new CurrencyApi();
        $this->exchangeRate = $Api->getExchangeRate($this->currencyCode);
    }
}
