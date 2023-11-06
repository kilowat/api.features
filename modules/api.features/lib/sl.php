<?php

use Bitrix\Main\DI\ServiceLocator;
$sl = ServiceLocator::getInstance();
/*
$sl->addInstanceLazy(
    'userRepository', [
        'constructor' => static function () use($sl) {
            return new UserOrmRepository();
        }]
);
*/