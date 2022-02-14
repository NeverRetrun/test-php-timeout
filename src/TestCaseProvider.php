<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout;


class TestCaseProvider
{
    /**
     * 执行长时间的SQL
     * @return string
     */
    public static function getExecuteLongTimeSql(): string
    {
        return <<<SQL
select id,ml_num from listing LIMIT 1000000
SQL;
    }

    public static function getTestJsonArray(): array
    {
        return json_decode(
            <<<JSON
{
	"agent": "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)",
		"bytes": 2492,
		"clientip": "177.111.217.54",
		"extension": "",
		"geo": {
			"srcdest": "MZ:US",
			"src": "MZ",
			"dest": "US",
			"coordinates": {
				"lat": 46.77917333,
				"lon": -105.3047083
			}
		},
		"host": "www.elastic.co",
		"index": "kibana_sample_data_logs",
		"ip": "177.111.217.54",
		"machine": {
			"ram": 9663676416,
			"os": "win 7"
		},
		"memory": null,
		"message": "177.111.217.54 - - [2018-07-22T03:37:04.863Z] \"GET /enterprise_1 HTTP/1.1\" 200 2492 \"-\" \"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)\"",
		"phpmemory": null,
		"referer": "http://twitter.com/success/gregory-harbaugh",
		"request": "/enterprise",
		"response": 200,
		"tags": [
			"success",
			"info"
		],
		"timestamp": "2021-06-20T03:37:04.863Z",
		"url": "https://www.elastic.co/downloads/enterprise_1",
		"utc_time": "2021-06-20T03:37:04.863Z",
		"event": {
			"dataset": "sample_web_logs"
		}
}
JSON
            ,
            true
        );
    }
}