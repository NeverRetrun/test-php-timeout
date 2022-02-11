<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout;


class Config
{
    /**
     * @var Config
     */
    protected static $instance;

    /**
     * @var \Dotenv\Repository\RepositoryInterface
     */
    protected $repository;

    protected function __construct()
    {
        $this->repository = \Dotenv\Repository\RepositoryBuilder::createWithDefaultAdapters()
            ->make();

        $dotenv = \Dotenv\Dotenv::create($this->repository, dirname(__DIR__));
        $dotenv->load();
    }

    public static function instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get(string $key, $default = null): ?string
    {
        return $this->repository->get($key, $default);
    }
}