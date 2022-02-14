<?php declare(strict_types=1);


namespace Cvoid\TestPhpTimeout;


class Timer
{
    public static function tick(string $nickname, callable $callable)
    {
        $startTime = time();
        try {
            return $callable();
        } catch (\Throwable $e) {
            var_dump($e->getTraceAsString());
            echo "Error!: " . $e->getMessage() . PHP_EOL;
        } finally {
            $endTime = time();
            echo "$nickname Time: " . ($endTime - $startTime) . "s" . PHP_EOL;
        }

        return null;
    }
}