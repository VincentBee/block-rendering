<?php

declare(strict_types=1);

namespace App\Routing;

use App\HttpClient\RouteConfiguration;
use Symfony\Bundle\FrameworkBundle\Routing\RouteLoaderInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class RouteLoader implements RouteLoaderInterface
{
    /**
     * @var RouteConfiguration
     */
    private $routeConfiguration;

    /**
     * RouteLoader constructor.
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(
        RouteConfiguration $routeConfiguration
    ) {
        $this->routeConfiguration = $routeConfiguration;
    }

    /**
     * @return RouteCollection
     */
    public function loadRoutes(): RouteCollection
    {
        $routes = new RouteCollection();

        foreach ($this->routeConfiguration->fetch() as $routeConfiguration) {
            $routeIdentifier = $routeConfiguration['id'];
            $routes->add("custom_$routeIdentifier", new Route($routeConfiguration['path'], [
                '_controller' => 'App\Controller\GeneralController::index',
                'blocks' => $routeConfiguration['blocks']
            ]));
        }

        return $routes;
    }
}
