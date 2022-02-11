<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout\ClientBuilder;


use Cvoid\TestPhpTimeout\Config;
use PDO;

class TestPdoBuilder
{

    protected $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public static function fromMockConfig(): self
    {
        $config = Config::instance();
        return new static([
            'dbms' => 'mysql',
            'attrs' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ],
            'user' => 'root',
            'pass' => '',
            'host' => $config->get('TCP_SERVER_IP'),
            'dbName' => 'test',
            'port' => $config->get('TCP_SERVER_PORT'),
        ]);
    }

    public static function fromNormalConfig(): self
    {
        $config = Config::instance();
        return new static([
            'dbms' => 'mysql',
            'attrs' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ],
            'user' => $config->get('MYSQL_USER'),
            'pass' => $config->get('MYSQL_PASSWORD'),
            'host' => $config->get('MYSQL_HOST'),
            'dbName' => $config->get('MYSQL_DATABASE'),
            'port' => $config->get('MYSQL_PORT'),
        ]);
    }

    public function appendAttrTimeout(int $attrTimeout = 0): self
    {
        if ($attrTimeout > 0) {
            $this->config['attrs'][PDO::ATTR_TIMEOUT] = $attrTimeout;
        } else {
            unset($this->config['attrs'][PDO::ATTR_TIMEOUT]);
        }

        return $this;
    }

    public function build(): PDO
    {
        [
            'dbms' => $dbms,
            'attrs' => $attrs,
            'user' => $user,
            'pass' => $pass,
            'host' => $host,
            'dbName' => $dbName,
            'port' => $port,
        ] = $this->config;

        return new PDO("$dbms:host=$host;port=$port;dbname=$dbName", $user, $pass, $attrs);
    }
}