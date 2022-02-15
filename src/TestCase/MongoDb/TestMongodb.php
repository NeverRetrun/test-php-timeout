<?php declare(strict_types=1);

namespace Cvoid\TestPhpTimeout\TestCase\MongoDb;

use Cvoid\TestPhpTimeout\ClientBuilder\TestMongoDbBuilder;
use Cvoid\TestPhpTimeout\Config;
use Cvoid\TestPhpTimeout\TestCase\TestCase;
use Cvoid\TestPhpTimeout\Timer;

class TestMongodb implements TestCase
{
    public function testLongTCPConnect(): void
    {
        TestMongoDbBuilder::fromNormalConfig()
//            ->appendConnectTimeoutMs()
            ->appendSocketTimeoutMs()
            ->build()
            ->selectCollection('test', 'test')
            ->find(['_id' => 1]);
    }

    public function testExecuteLongTimeSql(): void
    {
        $database = Config::instance()->get('MONGO_DATABASE');

        $connect = TestMongoDbBuilder::fromNormalConfig()
            ->appendConnectTimeoutMs()
//            ->appendSocketTimeoutMs()
            ->build()
            ->selectCollection($database, 'mls_treb_vow');

        $query = function () use ($connect) {
            $result = $connect
                ->find(
                    [],
                    [
                        'sort' => [],
                        'limit' => 5000,
                        'maxTimeMS' => 1000,
                    ]);
            foreach ($result as $item) {
            }
        };

        Timer::tick(
            '第一次连接与查询',
            function () use ($query) {
                $query();
            }
        );

        Timer::tick(
            '第二次查询时间',
            function () use ($query) {
                $query();
            }
        );
    }
}