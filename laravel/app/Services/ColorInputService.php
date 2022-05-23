<?php

namespace App\Services;

use GuzzleHttp\Client;
use Carbon\Carbon;

class ColorInputService
{
    const DATE = '22.08.1994.';

    protected $client;
    protected $entryPoint;
    protected $options = [];

    public function __construct($entryPoint = 'external-api')
    {
        $this->client = (new Client([
            'base_uri' => 'https://address.com/',
            'verify' => false,
        ]));

        $this->entryPoint = '/' . $entryPoint;

        $this->options = [
            'auth' => [
                'username',
                'password'
            ]
        ];
    }

    public function getDataFromService()
    {
        $response = $this->makeRequest('/data/statuses');
        return $response;
    }

    public function sendDataToServer($meastrument)
    {
        //
    }

    /**
     * Function get all data example
     * 
     * @param Carbon $date
     * @return Array $response
     */
    protected function getAllData($date = null)
    {
        $options = array_merge($this->options, [
            'query' => [
                'date' => $date ?? self::DATE
            ],
        ]);
        $response = $this->makeRequest('/data/all', $options);
        return $response;
    }

    /**
     * This function make request whit guzzle client http
     * and return response
     * 
     * @param string $endPoint      this is endpoint
     * @param array $option = null   this is array of options
     * @param string method     this is method name
     * 
     * @return array $response
     */
    protected function makeRequest($endPoint, $options = null, $method = 'get')
    {
        $response = json_decode(
            $this->client->$method(
                $this->entryPoint . $endPoint,
                $options ?? $this->options
            )->getBody(),
            true
        );
        return $response;
    }
}
