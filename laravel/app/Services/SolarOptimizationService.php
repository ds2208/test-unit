<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Carbon\Carbon;
use App\Models\Measurement;

class SolarOptimizationService
{

    protected $client;
    protected $entryPoint;
    protected $options = [];

    public function __construct($entryPoint = 'ExternalApi')
    {
        $this->client = (new Client([
            'base_uri' => 'https://usersupport.dexpress.rs/', //'http://109.245.241.249:8080',
            'verify' => false,
        ]));

        $this->entryPoint = '/' . $entryPoint;

        $this->options = [
            'auth' => [
                '71AFEE37-64FA-4D6E-B402-7ADFB540C201',
                '@kf7)Q2c}g'
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
     * Function get list of municipalities from Dexpress side
     * 
     * @param Carbon $date
     * @return Array $response
     */
    protected function getMunicipalitiesData($date = null)
    {
        $options = array_merge($this->options, [
            'query' => [
                'date' => $date ?? self::DATE
            ],
        ]);
        $response = $this->makeRequest('/data/municipalities', $options);
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
