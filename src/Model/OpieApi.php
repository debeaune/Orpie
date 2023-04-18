<?php

namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class OpieApi
{
    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public static function media(int $id): array
    {
        $url = 'https://taxref.mnhn.fr/api/taxa/' . $id . '/media';
        if(isset($url)){
            try {
                $client = HttpClient::create();
                $response = $client->request('GET', $url);
                return $response->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
    }

    /**
     * @param int $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public static function detail(int $id): array
    {
        $url = 'https://taxref.mnhn.fr/api/taxa/' . $id;
        if(isset($url)){
        try {
            $client = HttpClient::create();
            $response = $client->request('GET', $url);
            //dd($response);
            return $response->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
    }   

    public static function habitat(int $id): array
    {
        $url = 'https://taxref.mnhn.fr/api/habitats/' . $id;
        if(isset($url)){
        try {
            $client = HttpClient::create();
            $response = $client->request('GET', $url);
            return $response->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
    }
}