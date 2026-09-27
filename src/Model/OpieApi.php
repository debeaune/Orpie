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
    
    public static function detail(string $nom): array
    {
        $nomEncoded = urlencode($nom);
        $url = 'https://api.inaturalist.org/v1/taxa?q=' . $nomEncoded;
        try {
            $client = HttpClient::create();
            $response = $client->request('GET', $url);
            $data = $response->toArray();
            if(isset($data['results'][0])){
                return $data['results'][0];
            }
            return [];
        } catch (\Exception $e) {
            return []; // affiche l'erreur au lieu de la cacher
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