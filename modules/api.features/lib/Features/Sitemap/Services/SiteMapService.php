<?php

namespace Api\Features\Sitemap\Services;

use Api\Core\BaseController;
use Api\Features\Sitemap\Models\SiteMapLinkModel;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Application;


class SiteMapService extends BaseController
{

    public function take(array $iblockIds): array
    {
        $result = [];
        $iblockMap = [];
        $iblockCollection = IblockTable::getList([
            'filter' => ['ID' => $iblockIds],
            'select' => ['ID', 'CODE']
        ])->fetchCollection();

        foreach ($iblockCollection as $bItem) {
            $iblockMap[$bItem->getId()] = $bItem->getCode();
        }

        $queryElement = ElementTable::query();
        $queryElement->setFilter(['IBLOCK_ID' => $iblockIds]);
        $queryElement->setSelect(['ID','CODE', 'IBLOCK_ID']);
        $elementCollection = $queryElement->exec()->fetchCollection();
        $router = Application::getInstance()->getRouter();
        foreach ($elementCollection as $eItem) {
            $routeParam = [
                'id' => $eItem->getId(),
            ];
            $iblockCode = $iblockMap[$eItem->getIblockId()];
            $showRoute = $iblockCode.'.show';
            $fullPath = $router->route($showRoute, $routeParam) ?? '';
            $uri = str_replace('/api', '', $fullPath);
            $result[] = new SiteMapLinkModel(
                iblock: $iblockCode,
                id: $eItem->getId(),
                fullPath: getDomain().$fullPath,
                uri: $uri,
            );
        }
        return $result;
    }
}