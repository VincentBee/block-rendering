<?php

declare(strict_types=1);

namespace App\HttpClient;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RouteConfiguration
{
    /**
     * @var HttpClientInterface The http client used to fetch the route configuration
     */
    private $client;

    /**
     * RouteConfiguration constructor.
     *
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve the route configuration.
     *
     * @return array
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetch(): array
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:8000/data/routes.json'
        );

        return json_decode($response->getContent(), true);
    }
}