<?php

require_once '../vendor/autoload.php';

$config = \Cvoid\TestPhpTimeout\Config::instance();

$address = $config->get('TCP_SERVER_IP');
$port = $config->get('TCP_SERVER_PORT');

$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("socket_create() fail:" . socket_strerror(socket_last_error()) . "/n");
socket_set_block($sock) or die("socket_set_block() fail:" . socket_strerror(socket_last_error()) . "/n");
$result = socket_bind($sock, $address, $port) or die("socket_bind() fail:" . socket_strerror(socket_last_error()) . "/n");
$result = socket_listen($sock, 4) or die("socket_listen() fail:" . socket_strerror(socket_last_error()) . "/n");
echo "OK\nBinding the socket on $address:$port ... ";
echo "OK\nNow ready to accept connections.\nListening on the socket ... \n";
do {
    socket_accept($sock) or die("socket_accept() failed: reason: " . socket_strerror(socket_last_error()) . "/n");
    while (1) {
        echo "Read mysql client data \n";
        sleep(40);
        echo "sleep 40s \n";
        exit;
    }
} while (true);
socket_close($sock);