<?php

use Cvoid\TestPhpTimeout\TestCaseFactory;
use Cvoid\TestPhpTimeout\Timer;

ini_set("memory_limit", "1024M");

require_once '../vendor/autoload.php';

Timer::tick(
    '总时间',
    function () {
        $factory = new TestCaseFactory();

        $factory->monogodb()->testExecuteLongTimeSql();
    }
);
