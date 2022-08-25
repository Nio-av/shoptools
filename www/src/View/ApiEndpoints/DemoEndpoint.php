<?php

namespace App\View\ApiEndpoints;

class DemoEndpoint
{
    /**
     * Returns dummy data
     *
     * @param string $type Json OR Xml OR Csv
     */
    public function renderAction(string $type = "Json"): void
    {
        switch ($type) {
            case 'Json':
                $this->getExchangeRateJson();
                break;
            case 'Csv':
                $this->getExchangeRateCsv();
                break;
            case 'Xml':
                $this->getExchangeRateXml();
                break;
        }
    }

    private function array2csv(array $data, string $delimiter = ',', $enclosure = '"', string $escape_char = "\\"): string
    {
        $f = fopen('php://memory', 'r+');

        fputcsv($f, array_keys($data[0]));
        foreach ($data as $key => $item) {
            fputcsv($f, $item, $delimiter, $enclosure, $escape_char);
        }
        rewind($f);
        return stream_get_contents($f);
    }

    private function array2xml(array  $array): string
    {
        $xml = new \SimpleXMLElement('<root/>');
        array_walk_recursive($array, array($xml, 'addChild'));
        return $xml->asXML();
    }

    private function getExchangeRate(): array
    {
        $exchangeRate =  [
            'baseCurrency' => 'EUR',
            'exchangeRates' => [
                'EUR' => '1',
                'USD' => '5',
                'CHF' => '0.97',
                'CNY' => '2.3'
            ]
        ];
        return $exchangeRate;
    }

    public function getExchangeRateCsv(): string
    {
        $r = $this->array2csv([$this->getExchangeRate()['exchangeRates']]);
        header("Content-type: text/csv");
        echo $r;
        return $r;
    }

    public function getExchangeRateJson(): string
    {
        header('Content-Type: application/json; charset=utf-8');
        $r = json_encode($this->getExchangeRate());
        echo $r;
        return $r;
    }

    public function getExchangeRateXml(): string
    {
        $exchangeRate = $this->getExchangeRate()['exchangeRates'];
        $r = $this->array2xml(array_flip($exchangeRate));
        header('Content-Type: application/xml; charset=utf-8');
        echo $r;
        return $r;
    }
}
