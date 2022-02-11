<?php declare(strict_types=1);

namespace Cvoid\TestPhpTimeout\TestCase\MongoDb;

use Cvoid\TestPhpTimeout\ClientBuilder\TestMongoDbBuilder;
use Cvoid\TestPhpTimeout\TestCase\TestCase;
use Cvoid\TestPhpTimeout\Timer;

class TestMongodb implements TestCase
{
    public function testLongTCPConnect(): void
    {
        TestMongoDbBuilder::fromMockConfig()
            ->appendConnectTimeoutMs()
            ->build()
            ->selectCollection('test', 'test')
            ->find(['_id' => 1]);
    }

    public function testExecuteLongTimeSql(): void
    {
        $now = Timer::tick(
            '连接Mongodb数据库时间',
            function () {
                return TestMongoDbBuilder::fromNormalConfig()
                    ->appendConnectTimeoutMs()
//                    ->appendSocketTimeoutMs()
                    ->build()
                    ->selectCollection('housesigma', 'mls_treb_vow')
                    ->find(
                        [],
                        [
                            'sort' => [],
                            'limit' => 5000,
                            'maxTimeMS' => 1000,
                        ]);
            }
        );

        Timer::tick(
            'mongodb查询时间',
            function () use ($now) {
                foreach ($now as $item) {
                }
            }
        );
    }
}