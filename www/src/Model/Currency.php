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
    }

    /**
     * @return string ISO 4217
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }
}
