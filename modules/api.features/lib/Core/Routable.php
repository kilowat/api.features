<?php


namespace Api\Core;


use Bitrix\Main\Routing\RoutingConfigurator;

interface Routable
{
    public static function registerRoutes(RoutingConfigurator $routes);
}