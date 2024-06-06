<?php

namespace App\Services;

use GuzzleHttp\Client;

class PrintfulService
{
    protected $client;

    public function getSyncedProducts()
    {
        $apiKey = 'rQWm9HqtDECIuYY4TQg3CsRTeJPmNDJ9KD0jy97B';
        $baseUrl = 'https://api.printful.com/';

        $client = new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
            ],
        ]);

        $response = $client->get('sync/products');
        $products = json_decode($response->getBody()->getContents(), true);

        return response()->json($products);
    }

    

    


    // protected $client;
    // protected $apiKey;

    // public function __construct()
    // {
    //     $this->apiKey = 'bWEZM1YZaJUDGNBDEmoYpdMTcpbt01BDvq0DCvBn';
    //     $this->client = new Client([
    //         'base_uri' => 'https://api.printful.com/',
    //     ]);
    // }

    // public function getProducts()
    // {
    //     $response = $this->client->get('products');
    //     return json_decode($response->getBody(), true);
    // }

}

