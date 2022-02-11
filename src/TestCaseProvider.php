<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout;


class TestCaseProvider
{
    /**
     * 执行长时间的SQL
     * @return string
     */
    public static function getExecuteLongTimeSql(): string
    {
        return <<<SQL
select id,ml_num from listing LIMIT 1000000
SQL;
    }
}