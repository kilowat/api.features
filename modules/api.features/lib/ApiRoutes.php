<?php
namespace Api;
use Api\Core\Routable;
use Bitrix\Main\Routing\RoutingConfigurator;


class ApiRoutes implements Routable {

    public static function registerRoutes(RoutingConfigurator $routes): RoutingConfigurator
    {
        return $routes;
    }
}
