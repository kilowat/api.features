<?php

namespace Api\Core;

class OrmTracker
{
    public static function start($reset = false): void
    {
        \Bitrix\Main\Application::getInstance()->getConnectionPool()->getConnection()->startTracker($reset);
    }

    public static function stop(): void
    {
        \Bitrix\Main\Application::getInstance()->getConnectionPool()->getConnection()->stopTracker();
    }

    public static function get(): ?\Bitrix\Main\Diag\SqlTracker
    {
        return \Bitrix\Main\Application::getInstance()->getConnectionPool()->getConnection()->getTracker();
    }
}