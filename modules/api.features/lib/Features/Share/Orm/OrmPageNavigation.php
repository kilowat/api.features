<?php

namespace Api\Features\Share\Misc;

use Bitrix\Main\ORM\Fields\ExpressionField;
use Bitrix\Main\UI\PageNavigation;

class OrmPageNavigation extends PageNavigation
{
   public function __construct(string $id, $currentPage, $sizePage, $table ,$filter = [])
   {
       parent::__construct($id);
       $this->setPageSize($sizePage)
           ->setCurrentPage($currentPage);

       (int)$count = $table::getList(array(
           'select' => ['count'],
           'filter' => $filter,
           'runtime' => array(
               new ExpressionField('count', 'COUNT(*)')
           )
       ))->fetch()['count'] ?? 0;

       $this->setRecordCount($count);
       if($count == 0) return;
       if($this->getCurrentPage() > $this->getPageCount()){
           $this->setCurrentPage($this->getPageCount());
       }
   }
}