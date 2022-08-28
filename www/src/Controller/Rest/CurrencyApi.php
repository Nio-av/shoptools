<?php

namespace App\Controller\Rest;

/**
 * Basic Communication with REST API
 */
class CurrencyApi extends RestService
{
    protected const API_ENDPOINT = "http://localhost/";

    /**
     * Load Exchange Rate from API
     *
     * @return float[] associative array; format: [[EUR] => 1, [USD] => 5, ...]
     */
    public function getExchangeRates(string $sourceCurrency): array
    {
        $this->setApiRessource('api/' . $sourceCurrency . '.php?type=Json');
        $apiData = $this->get();
        // TODO: Include Translator for CSV / XML here
        $apiData = json_decode($apiData);

        $apiData = $this->translateJsonObjectToArray($apiData);
        if (count($apiData) < 1) {
            // TODO: Log Error
            throw new \ErrorException('No Exchange Rates Available');
        }
        return $apiData;
    }

    /**
     * Convert a JSON Object with exchange rates to an array
     *
     * @param object $object JSON Object
     */
    private function translateJsonObjectToArray(object $object): array
    {
        if (property_exists($object, 'exchangeRates')) {
            $exchangeRates = (array) $object->exchangeRates;
            $exchangeRates = array_map('floatval', $exchangeRates);

            $exchangeRates = array_map(function ($v) {
                return round($v, 2, PHP_ROUND_HALF_UP);
            }, $exchangeRates);


            if (count($exchangeRates) < 1) {
                // TODO: Log Error
            }
            return $exchangeRates;
        } else {
            // TODO: Include Error Logger
        }
    }
}
