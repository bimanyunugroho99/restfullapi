<?php

namespace App\Libraries;

use GuzzleHttp\Client;

class Property
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => getenv('property.apiURL')
        ]);
    }

    public function getAllProperty()
    {
        $response = $this->_client->request('get', 'property', []);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }

    public function getById($slug)
    {
        $response = $this->_client->request('get', 'property/' . $slug, [
            'query' => []
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }

    public function deleteProperty($slug)
    {
        $response = $this->_client->request('delete', 'property/' . $slug, []);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}
