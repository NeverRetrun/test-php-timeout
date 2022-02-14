<?php declare(strict_types=1);

namespace Cvoid\TestPhpTimeout;

use Cvoid\TestPhpTimeout\TestCase\ElasticSearch\TestElasticSearch;
use Cvoid\TestPhpTimeout\TestCase\MongoDb\TestMongodb;
use Cvoid\TestPhpTimeout\TestCase\MySql\TestDefaultSocketTimeout;
use Cvoid\TestPhpTimeout\TestCase\MySql\TestMysqlndConfig;
use Cvoid\TestPhpTimeout\TestCase\MySql\TestPdoAttrTimeout;
use Cvoid\TestPhpTimeout\TestCase\Redis\TestPRedis;
use Cvoid\TestPhpTimeout\TestCase\Redis\TestRedis;
use Cvoid\TestPhpTimeout\TestCase\TestCase;

class TestCaseFactory
{
    public function mysqlndConfig(): TestCase
    {
        return new TestMysqlndConfig();
    }

    public function pdoAttrTimeout(): TestCase
    {
        return new TestPdoAttrTimeout();
    }

    public function defaultSocketTimeout(): TestCase
    {
        return new TestDefaultSocketTimeout();
    }

    public function monogodb(): TestCase
    {
        return new TestMongodb();
    }

    public function redis(): TestCase
    {
        return new TestRedis();
    }

    public function predis(): TestCase
    {
        return new TestPRedis();
    }

    public function elasticSearch(): TestCase
    {
        return new TestElasticSearch();
    }
}