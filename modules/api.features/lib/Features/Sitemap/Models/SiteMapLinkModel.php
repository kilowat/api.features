<?php

namespace Api\Features\Sitemap\Models;

class SiteMapLinkModel
{
    public function __construct(
        public string $iblock,
        public string $id,
        public string $fullPath,
        public string $uri,
    )
    {
    }
}