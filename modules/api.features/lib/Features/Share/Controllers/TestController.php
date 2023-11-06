<?php

namespace Api\Features\Share\Controllers;

use Api\Core\BaseController;
use Api\Features\Drug\Orm\DrugsTable;
use Api\Features\Share\Components\SmartFilter;

class TestController extends BaseController
{
    public function runAction()
    {
        $smartFilter = new SmartFilter(\AppConf::get('drugs.iblock'));
        $filter = [];
        $smartFilter->apply($filter);

        return DrugsTable::getList([
            'filter' => $filter,
            'select' => ['ID']])->fetchAll();
    }
}