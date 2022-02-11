<?php

namespace Cvoid\TestPhpTimeout\TestCase;

interface TestCase
{
    /**
     * 测试长时间TCP连接 不回应的情况
     * @return void
     */
    public function testLongTCPConnect(): void;

    /**
     * 测试长时间执行的SQL
     * @return void
     */
    public function testExecuteLongTimeSql(): void;
}