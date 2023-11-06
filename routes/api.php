<?php

use Api\ApiRoutes;
use Bitrix\Main\Routing\RoutingConfigurator;
include_once($_SERVER['DOCUMENT_ROOT'] . '/local/modules/api.features/lib/bootstrap.php');

return function (RoutingConfigurator $routes) {
    $routes->prefix('api')->group(function (RoutingConfigurator $routes) {
        ApiRoutes::registerRoutes($routes);
        $routes->any('{path}', function() {
            header("HTTP/1.1 404 Not Found");
            return [];
        })->where('path', '.*'); ;
    });
};