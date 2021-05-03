<?php

declare(strict_types=1);

namespace App\Routing;

use App\HttpClient\RouteConfiguration;
use Symfony\Bundle\FrameworkBundle\Routing\RouteLoaderInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class RouteLoader implements RouteLoaderInterface
{
    /**
     * @var RouteConfiguration
     */
    private $routeConfiguration;

    /**
     * @var string[]
     */
    private $controllerMap = [
        'classical' => 'App\Controller\GeneralController::classical',
        'standalone' => 'App\Controller\GeneralController::standalone',
    ];

    /**
     * @var string
     */
    private $defaultController;

    /**
     * RouteLoader constructor.
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(
        RouteConfiguration $routeConfiguration
    ) {
        $this->routeConfiguration = $routeConfiguration;
        $this->defaultController = $this->controllerMap['classical'];
    }

    /**
     * @return RouteCollection
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function loadRoutes(): RouteCollection
    {
        $routes = new RouteCollection();

        foreach ($this->routeConfiguration->fetch() as $routeConfiguration) {
            $routeIdentifier = $routeConfiguration['id'];
            $routes->add("custom_$routeIdentifier", new Route($routeConfiguration['path'], [
                '_controller' => $this->controllerMap[$routeConfiguration['type']]?: $this->defaultController,
                'blocks' => $routeConfiguration['blocks']
            ]));
        }

        return $routes;
    }
}
