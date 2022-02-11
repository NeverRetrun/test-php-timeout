<?php declare(strict_types=1);

namespace Cvoid\TestPhpTimeout\TestCase\MySql;

use Cvoid\TestPhpTimeout\ClientBuilder\TestPdoBuilder;
use Cvoid\TestPhpTimeout\TestCase\TestCase;
use Cvoid\TestPhpTimeout\TestCaseProvider;

class TestPdoAttrTimeout implements TestCase
{
    /**
     * 测试 PDO::ATTR_TIMEOUT 属性
     * 无法起到作用 TCP服务器 sleep多久 PDO连接就会被Hold多久
     * @asset fail
     * @return void
     */
    public function testLongTCPConnect(): void
    {
        $pdo = TestPdoBuilder::fromMockConfig()->appendAttrTimeout(1)->build();
        $pdo->query('SELECT 1');
    }

    public function testExecuteLongTimeSql(): void
    {
        TestPdoBuilder::fromNormalConfig()
            ->appendAttrTimeout(1)
            ->build()
            ->query(TestCaseProvider::getExecuteLongTimeSql());
    }
}