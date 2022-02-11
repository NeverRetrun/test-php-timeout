<?php declare(strict_types=1);

namespace Cvoid\TestPhpTimeout;

use Cvoid\TestPhpTimeout\TestCase\MongoDb\TestMongodb;
use Cvoid\TestPhpTimeout\TestCase\MySql\TestDefaultSocketTimeout;
use Cvoid\TestPhpTimeout\TestCase\MySql\TestMysqlndConfig;
use Cvoid\TestPhpTimeout\TestCase\MySql\TestPdoAttrTimeout;
use Cvoid\TestPhpTimeout\TestCase\Redis\TestRedis;

class TestCaseFactory
{
    public function mysqlndConfig(): TestMysqlndConfig
    {
        return new TestMysqlndConfig();
    }

    public function pdoAttrTimeout(): TestPdoAttrTimeout
    {
        return new TestPdoAttrTimeout();
    }

    public function defaultSocketTimeout(): TestDefaultSocketTimeout
    {
        return new TestDefaultSocketTimeout();
    }

    public function monogodb(): TestMongodb
    {
        return new TestMongodb();
    }

    public function redis(): TestRedis
    {
        return new TestRedis();
    }
}