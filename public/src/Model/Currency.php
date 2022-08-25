<?php

namespace App\Model;


/**
 * Basic getter for a currency
 */
class Currency
{
    /**
     * Name of currency
     */
    protected string $currencyName;
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
    public function __construct(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }



    /**
     * @param float[] $exchangeRate associative array; format: [[EUR] => 1, [USD] => 5,]
     * @return void
     */
    public function setExchangeRate(array $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    public function getExchangeRate(): array
    {
        return $this->exchangeRate;
    }
}
