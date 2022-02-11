<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout\ClientBuilder;


use Cvoid\TestPhpTimeout\Config;
use Redis;

class TestRedisBuilder
{
    protected $host = '';

    protected $port = 6379;

    protected $auth = '';

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
        float $connectionTimeout,
        string $auth
    )
    {
        $this->host = $host;
        $this->port = $port;
        $this->connectionTimeout = $connectionTimeout;
        $this->auth = $auth;
    }

    public static function fromMockConfig(): self
    {
        $config = Config::instance();
        return new static(
            $config->get('TCP_SERVER_IP'),
            (int)$config->get('TCP_SERVER_PORT'),
            2.0,
            ''
        );
    }

    public static function fromNormalConfig(): self
    {
        $config = Config::instance();
        return new static(
            $config->get('REDIS_HOST'),
            (int)$config->get('REDIS_PORT'),
            2.0,
            $config->get('REDIS_AUTH')
        );
    }

    public function setConnectionTimeout(float $connectionTimeout): self
    {
        $this->connectionTimeout = $connectionTimeout;
        return $this;
    }

    public function setReadTimeout(float $readTimeout): self
    {
        $this->readTimeout = $readTimeout;
        return $this;
    }

    public function build(): Redis
    {
        $redis = new Redis();

        $redis->connect(
            $this->host,
            $this->port,
            $this->connectionTimeout,
            null,
            0,
            $this->readTimeout
        );
        $redis->auth($this->auth);
        return $redis;
    }
}