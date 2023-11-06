<?php

namespace Api\Features\Sitemap\Services;

use Api\Core\TagsCache;

class SiteMapCachedService
{
    use TagsCache;
    public function __construct(
        private SiteMapService $siteMapService,
    )
    {
    }

    public function take(array $iblockIds)
    {
        return $this->toCache(
           callback:  fn() => $this->siteMapService->take($iblockIds),
           cacheKey: md5(serialize($iblockIds)),
           cachePath: 'api/sitemap',
           iblockIdS: $iblockIds,
           useLinkedProps: false
        );

    }
}