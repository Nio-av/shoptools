<?php

namespace App\Controller;

/**
 * Grundlegende Kommunikation mit einer REST API
 */
class RestController
{
    protected const API_ENDPOINT = "";
    protected const USERNAME = "";
    protected const PASSWORD = "";
    protected string $apiKey = "";
    protected string $apiToken = "";

    // TODO: Check this constant before golive
    private const DEBUGMODE = false;

    /**
     * Contains Result of REST-Request
     */
    public ?string $output;
    /**
     * Contains MEta-Information of the Request
     */
    public $info;


    /**
     * Contains specific Api-Resource
     */
    protected string $apiRessource = "";

    /**
     * Contains JSON with Information to Upload
     */
    protected string $requestBody = "";


    /**
     * Contains Data that has to be uploaded
     */
    protected function setRequestBody(array $array): void
    {
        $this->requestBody = json_encode($array);
    }

    protected function setApiRessource(string $apiRessource): void
    {
        $this->apiRessource = $apiRessource;
    }

    /**
     * Updaten an exiting Ressource
     */
    protected function put(): string
    {
        $curlOpt = [
            [
                'option' => CURLOPT_POST, // wenn hier put steht, werden keine daten mitgesendet
                'value' => true,
            ],
            [
                'option' => CURLOPT_RETURNTRANSFER,
                'value' => 1,
            ],
            [
                'option' => CURLOPT_HTTPHEADER,
                'value' => ['Content-Length: ' . strlen($this->requestBody)],
            ],
            [
                'option' => CURLOPT_CUSTOMREQUEST,  // ist zum erzeugen eines put notwendig
                'value' => "PUT",
            ],
            [
                'option' => CURLOPT_POSTFIELDS,
                'value' => $this->requestBody,
            ]
        ];

        return $this->request($curlOpt);
    }

    /**
     * Execute POST - Request; create sth. new on Server
     */
    protected function post(): string
    {
        $curlOpt = [
            [
                'option' => CURLOPT_POST,
                'value' => 1,
            ],
            [
                'option' => CURLOPT_RETURNTRANSFER,
                'value' => 1,
            ],
            [
                'option' => CURLOPT_POSTFIELDS,
                'value' => $this->requestBody,
            ]
        ];
        return $this->request($curlOpt);
    }

    /**
     * execute get request
     */
    protected function get(): string
    {
        $curlOpt = [
            [
                'option' => CURLOPT_RETURNTRANSFER,
                'value' => 1,
            ]
        ];
        return $this->request($curlOpt);
    }

    /**
     * Entfernt das gegebene Modell
     */
    protected function delete(): string
    {
        $curlOpt = [
            [
                'option' => CURLOPT_CUSTOMREQUEST,
                'value' => "DELETE",
            ],
            [
                'option' => CURLOPT_RETURNTRANSFER,
                'value' => 1,
            ]
        ];
        return $this->request($curlOpt);
    }

    /**
     * Returns the final URL for REST-Request
     */
    private function getUrl(): string
    {
        $url = static::API_ENDPOINT . $this->apiRessource;

        if (!is_null($this->apiRessourceId)) {
            $url .= '/' . $this->apiRessourceId;
        }

        return $url;
    }


    /**
     * Execute request
     *
     * @link https://reqbin.com/req/php/5k564bhv/get-request-bearer-token-authorization-header-example
     * @param int[] $options
     * @throws Exception Curl Error if Request fails
     */
    private function request(array $options): string
    {

        // create curl resource
        $curl = curl_init($this->getUrl());

        // set url
        curl_setopt($curl, CURLOPT_URL, $this->getUrl());

        /** This is for Man-in-the-middel - Debugging, i.E. with mitmproxy */
        if (self::DEBUGMODE) {
            $proxyIP = '192.168.178.84';
            $proxyPort = '8080';

            //Set the proxy IP.
            curl_setopt($curl, CURLOPT_PROXY, $proxyIP);
            //Set the port.
            curl_setopt($curl, CURLOPT_PROXYPORT, $proxyPort);

            //for debug only!
            // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // https://www.php.net/manual/de/function.curl-setopt.php#110457
        }


        foreach ($options as $option) {
            //return the transfer as a string
            curl_setopt($curl, $option['option'], $option['value']);
        }

        // Basic auth
        curl_setopt($curl, CURLOPT_USERPWD, static::USERNAME . ":" . static::PASSWORD);



        $headers = [
            "Accept: application/json",
            //"Authorization: Bearer " . $this->apiToken, // Might be necessary
            "Content-Type: application/json",
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


        // $output contains the output string
        $this->output = curl_exec($curl);

        // Get potential Errors
        $curl_errno = curl_errno($curl);
        $curl_error = curl_error($curl);

        $this->info = curl_getinfo($curl);

        // close curl resource to free up system resources
        curl_close($curl);


        if ($curl_errno > 0) {
            throw new \Exception("cURL Error: $curl_error\n", $curl_errno);
        }

        return $this->output;
    }
}
