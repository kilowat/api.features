<?php

namespace Api\Features\Sitemap\Controllers;

use Api\Core\BaseController;
use Api\Features\Sitemap\Services\SiteMapCachedService;
use OpenApi\Attributes as OA;

class SiteMapController extends BaseController
{
    #[OA\Get(
        path: '/api/sitemap',
        description: 'Карта сайта',
        tags: ['Sitemap'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
            ),
        ]
    )]
    public function indexAction(
        SiteMapCachedService $siteMapService,
    )
    {
        $iblockIds = [
            \AppConf::get('drugs.iblock'),
            \AppConf::get('disease.iblock'),
            \AppConf::get('research.iblock'),
            \AppConf::get('cases.iblock'),
            \AppConf::get('clinics.iblock'),
        ];
        return $siteMapService->take($iblockIds);
    }
}