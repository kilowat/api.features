<?php
namespace Api\Features\Share\Components;
use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'arResult',
    type: 'object',
)]
class SmartFilter
{
    private int $iblockId;
    private string $sectionCode = '';

    public function __construct($iblockId)
    {
        $this->iblockId = $iblockId;
    }

    public function apply(&$filter, $sectionCode = '', $prefilter = []): static
    {
        if(empty($_REQUEST['del_filter']) && empty($_REQUEST['set_filter']))
            return $this;

        $this->init($sectionCode, $prefilter);
        global $arrFilter;

        $filter = array_merge($arrFilter, $filter);
        return $this;
    }

    private function init($sectionCode = '', $prefilter = []): void
    {
        global $APPLICATION;
        global $smartPreFilter;
        $smartPreFilter = $prefilter;
        $this->sectionCode = $sectionCode;

        $APPLICATION->IncludeComponent(
            "extend.mode:catalog.smart.filter",
            "",
            Array(
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "CONVERT_CURRENCY" => "N",
                "DISPLAY_ELEMENT_COUNT" => "Y",
                "PREFILTER_NAME" => "smartPreFilter",
                "FILTER_NAME" => "arrFilter",
                "FILTER_VIEW_MODE" => "vertical",
                "HIDE_NOT_AVAILABLE" => "N",
                "IBLOCK_ID" => $this->iblockId,
                "PAGER_PARAMS_NAME" => "arrPager",
                "POPUP_POSITION" => "left",
                "SAVE_IN_SESSION" => "N",
                "SECTION_CODE" => $sectionCode,
                "SECTION_CODE_PATH" => "",
                "SECTION_DESCRIPTION" => "-",
                "SECTION_TITLE" => "-",
                "SEF_MODE" => "N",
                "SEF_RULE" => "#SMART_FILTER_PATH#",
                "TEMPLATE_THEME" => "blue",
                "XML_EXPORT" => "N"
            )
        );
    }

    private function getIds($arrFilter)
    {
        $cache_id = md5(serialize($arrFilter) . $this->sectionCode);
        $cache_dir = "/smartFilter";
        $obCache = new \CPHPCache;

        if($obCache->InitCache(360000, $cache_id, $cache_dir)){
            $ids = $obCache->GetVars();
        }elseif ($obCache->StartDataCache()) {
            $res = \CIBlockElement::GetList(Array(), $arrFilter, false, false, ["ID"]);
            global $CACHE_MANAGER;

            $CACHE_MANAGER->StartTagCache($cache_dir);
            $CACHE_MANAGER->RegisterTag("iblock_id_".$this->iblockId);

            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $ids[] = $arFields["ID"];
            }
            $CACHE_MANAGER->RegisterTag("iblock_id_new");
            $CACHE_MANAGER->EndTagCache();
            $obCache->EndDataCache($ids);
        }else{
            $ids = [];
        }

        return $ids;
    }

    public function getData($sectionCode = '', $prefilter = []): array
    {
        $this->init($sectionCode = '', $prefilter = []);
        global $smartFilterResult;
        return $smartFilterResult;
    }
}