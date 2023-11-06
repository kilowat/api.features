<?php

namespace Api;
use OpenApi\Attributes as OA;

#[OA\Info(version: "0.1", title: "App Title")]
#[OA\Server(url: 'https://site.com')]
class OpenApi
{
}