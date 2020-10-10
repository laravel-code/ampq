<?php

namespace LaravelCode\AMPQ;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

interface ConnectionInterface
{
    public function __construct($host, $port, $user, $pass, $vhost, string $consumer);

    public function getConnection(): AMQPStreamConnection;

    public function getChannel(): AMQPChannel;

    public function getConsumer(): string;

    public function close();
}
