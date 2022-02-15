<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout\TestCase\MySql;


use Cvoid\TestPhpTimeout\ClientBuilder\TestPdoBuilder;
use Cvoid\TestPhpTimeout\TestCase\TestCase;
use Cvoid\TestPhpTimeout\TestCaseProvider;

class TestDefaultSocketTimeout implements TestCase
{
    public function testLongTCPConnect(): void
    {
        ini_set("default_socket_timeout", '1');
        $pdo = TestPdoBuilder::fromNormalConfig()->build();
        $pdo->query('SELECT 1');
    }

    public function testExecuteLongTimeSql(): void
    {
        ini_set("default_socket_timeout", '1');
        TestPdoBuilder::fromNormalConfig()
            ->build()
            ->query(TestCaseProvider::getExecuteLongTimeSql())
            ->fetchAll();
    }
}