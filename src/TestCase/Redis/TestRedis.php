<?php declare(strict_types=1);

namespace Cvoid\TestPhpTimeout\TestCase\Redis;

use Cvoid\TestPhpTimeout\ClientBuilder\TestRedisBuilder;
use Cvoid\TestPhpTimeout\TestCase\TestCase;

class TestRedis implements TestCase
{
    public function testLongTCPConnect(): void
    {
        TestRedisBuilder::fromNormalConfig()
            ->setConnectionTimeout(2.0)
            ->setReadTimeout(1.0)
            ->build();
    }

    public function testExecuteLongTimeSql(): void
    {
        $redis = TestRedisBuilder::fromNormalConfig()
            ->setConnectionTimeout(3.0)
            ->setReadTimeout(1.0)
            ->build();

        $redis->wait(2, 3000);
    }
}