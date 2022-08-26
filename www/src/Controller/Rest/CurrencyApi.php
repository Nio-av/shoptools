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
     * @param string $sourceCurrency
     */
    public function getExchangeRates(string $sourceCurrency): array
    {
        $this->setApiRessource('api/' . $sourceCurrency . '.php?type=Json');
        $apiData = $this->get();
        // TODO: Include Translator for CSV / XML here
        $apiData = json_decode($apiData);

        $apiData = $this->translateJsonObjectToArray($apiData);
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
            if (count($exchangeRates) < 1) {
                // TODO: Log Error
            }
            return $exchangeRates;
        } else {
            // TODO: Include Error Logger
        }
    }
}
