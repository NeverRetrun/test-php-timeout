<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout\ClientBuilder;


use Cvoid\TestPhpTimeout\Config;

class TestMongoDbBuilder
{
    protected $uri = '';

    protected $uriOptions = [];

    protected $driverOptions = [];

    public function __construct(
        string $uri,
        array $uriOptions = [],
        array $driverOptions = []
    )
    {
        $this->uri = $uri;
        $this->uriOptions = $uriOptions;
        $this->driverOptions = $driverOptions;
    }

    public static function fromMockConfig(): self
    {
        $config = Config::instance();

        $host = $config->get('TCP_SERVER_IP');
        $port = $config->get('TCP_SERVER_PORT');

        return new static(
            "mongodb://{$host}:{$port}",
            [
                'username' => 'root',
                'password' => '',
            ],
            []
        );
    }

    public function appendConnectTimeoutMs(): self
    {
        $this->uriOptions['connectTimeoutMS'] = 2000;
        return $this;
    }

    public function appendSocketTimeoutMs(): self
    {
        $this->uriOptions['socketTimeoutMS'] = 2000;
        return $this;
    }

    public static function fromNormalConfig(): self
    {
        $config = Config::instance();

        $host = $config->get('MONGO_HOST');
        $port = $config->get('MONGO_PORT');

        return new static(
            "mongodb://{$host}:{$port}",
            [
                'username' => $config->get('MONGO_USER'),
                'password' => $config->get('MONGO_PASSWORD'),
                'authSource' => $config->get('MONGO_AUTH_SOURCE'),
            ],
            [
                'typeMap' => [
                    'document' => 'array',
                    'array' => 'array',
                ],
            ]
        );
    }

    public function build(): \MongoDB\Client
    {
        return new \MongoDB\Client(
            $this->uri,
            $this->uriOptions,
            $this->driverOptions
        );
    }
}