<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout\TestCase\ElasticSearch;


use Cvoid\TestPhpTimeout\ClientBuilder\TestElasticSearchBuilder;
use Cvoid\TestPhpTimeout\TestCase\TestCase;
use Cvoid\TestPhpTimeout\TestCaseProvider;

class TestElasticSearch implements TestCase
{
    public function testLongTCPConnect(): void
    {
        TestElasticSearchBuilder::fromMockConfig()
            ->setReadTimeout(10)
//            ->setConnectionTimeout(10)
            ->build()
            ->ping();
    }

    public function testExecuteLongTimeSql(): void
    {
        $client = TestElasticSearchBuilder::fromNormalConfig()
            ->setReadTimeout(3)
            ->build();

        $data = TestCaseProvider::getTestJsonArray();


        for($i = 0; $i < 10000; $i++) {
            $params['body'][] = [
                'index' => [
                    '_index' => 'kibana_sample_data_logs',
                ]
            ];

            $params['body'][] = $data;
        }

        $client->bulk($params);
    }
}