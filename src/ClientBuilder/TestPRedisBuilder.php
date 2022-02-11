<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout\ClientBuilder;


use Cvoid\TestPhpTimeout\Config;

class TestPRedisBuilder
{
    /**
     * @var string
     */
    protected $host = '';

    /**
     * @var int
     */
    protected $port = 6379;

    /**
     * @var string
     */
    protected $auth = '';

    /**
     * @var float
     */
    protected $connectionTimeout = 0.0;

    /**
     * @var float
     */
    protected $readTimeout = 0.0;

    public function __construct(string $host, int $port, string $auth)
    {
        $this->host = $host;
        $this->port = $port;
        $this->auth = $auth;
    }

    /**
     * @param float $connectionTimeout
     * @return TestPRedisBuilder
     */
    public function setConnectionTimeout(float $connectionTimeout): TestPRedisBuilder
    {
        $this->connectionTimeout = $connectionTimeout;
        return $this;
    }

    /**
     * @param float $readTimeout
     * @return TestPRedisBuilder
     */
    public function setReadTimeout(float $readTimeout): TestPRedisBuilder
    {
        $this->readTimeout = $readTimeout;
        return $this;
    }

    public static function fromMockConfig(): self
    {
        $config = Config::instance();
        return new static(
            $config->get('TCP_SERVER_IP'),
            (int)$config->get('TCP_SERVER_PORT'),
            ''
        );
    }

    public static function fromNormalConfig(): self
    {
        $config = Config::instance();
        return new static(
            $config->get('REDIS_HOST'),
            (int)$config->get('REDIS_PORT'),
            $config->get('REDIS_AUTH')
        );
    }

    public function build(): \Predis\Client
    {
        $client = new \Predis\Client([
            'host' => $this->host,
            'port' => $this->port,
            'password' => $this->auth,
            'timeout' => $this->connectionTimeout,
            'read_write_timeout' => $this->readTimeout
        ]);
        $client->connect();
        $client->auth($this->auth);

        return $client;
    }
}