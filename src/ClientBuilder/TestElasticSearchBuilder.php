<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout\ClientBuilder;


use Cvoid\TestPhpTimeout\Config;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class TestElasticSearchBuilder
{
    /**
     * @var string
     */
    protected $host = '';

    /**
     * @var int 端口
     */
    protected $port = 9200;

    /**
     * @var string url路径
     */
    protected $path = '';

    /**
     * @var string
     */
    protected $user = '';

    /**
     * @var string
     */
    protected $password = '';

    /**
     * @var float
     */
    protected $connectionTimeout = 0.0;

    /**
     * @var float
     */
    protected $readTimeout = 0.0;

    public function __construct(
        string $host,
        int $port,
        string $path,
        string $user,
        string $password
    )
    {
        $this->host = $host;
        $this->port = $port;
        $this->path = $path;
        $this->user = $user;
        $this->password = $password;
    }

    public static function fromMockConfig(): self
    {
        $config = Config::instance();

        return new static(
            $config->get('TCP_SERVER_IP'),
            (int)$config->get('TCP_SERVER_PORT'),
            '/',
            '',
            ''
        );
    }

    public static function fromNormalConfig(): self
    {
        $config = Config::instance();

        return new static(
            $config->get('ELASTIC_SEARCH_HOST'),
            (int)$config->get('ELASTIC_SEARCH_PORT'),
            $config->get('ELASTIC_SEARCH_PATH'),
            $config->get('ELASTIC_SEARCH_USER'),
            $config->get('ELASTIC_SEARCH_PASSWORD')
        );
    }

    /**
     * @param float $connectionTimeout
     * @return TestElasticSearchBuilder
     */
    public function setConnectionTimeout(float $connectionTimeout): TestElasticSearchBuilder
    {
        $this->connectionTimeout = $connectionTimeout;
        return $this;
    }

    /**
     * @param float $readTimeout
     * @return TestElasticSearchBuilder
     */
    public function setReadTimeout(float $readTimeout): TestElasticSearchBuilder
    {
        $this->readTimeout = $readTimeout;
        return $this;
    }

    public function build(): Client
    {
        $connectParams = [
            'client' => [
                'connect_timeout' => $this->connectionTimeout,
                'timeout' => $this->readTimeout
            ]
        ];

        return ClientBuilder::create()
            ->setConnectionParams($connectParams)
            ->setHosts([
                [
                    'host' => $this->host,
                    'port' => $this->port,
                    'scheme' => 'http',
                    'path' => $this->path,
                    'user' => $this->user,
                    'pass' => $this->password
                ],
            ])
            ->build();
    }
}