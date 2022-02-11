<?php declare(strict_types=1);

namespace Cvoid\TestPhpTimeout\TestCase\Redis;

use Cvoid\TestPhpTimeout\ClientBuilder\TestRedisBuilder;
use Cvoid\TestPhpTimeout\TestCase\TestCase;

class TestRedis implements TestCase
{
    public function testLongTCPConnect(): void
    {
        TestRedisBuilder::fromMockConfig()
            ->setConnectionTimeout(1.0)
            ->setReadTimeout(1.0)
            ->build();
    }

    public function testExecuteLongTimeSql(): void
    {
        $redis = TestRedisBuilder::fromNormalConfig()
            ->build();


    }
}