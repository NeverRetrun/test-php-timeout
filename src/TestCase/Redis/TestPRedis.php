<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout\TestCase\Redis;


use Cvoid\TestPhpTimeout\ClientBuilder\TestPRedisBuilder;
use Cvoid\TestPhpTimeout\ClientBuilder\TestRedisBuilder;
use Cvoid\TestPhpTimeout\TestCase\TestCase;

class TestPRedis implements TestCase
{
    public function testLongTCPConnect(): void
    {
        $client = TestPRedisBuilder::fromMockConfig()
            ->setConnectionTimeout(5.0)
            ->setReadTimeout(5.0)
            ->build();
    }

    public function testExecuteLongTimeSql(): void
    {

    }
}