<?php

namespace LaravelCode\AMPQ;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Connector implements ConnectionInterface
{
    /**
     * @var AMQPStreamConnection
     */
    private $connection;
    /**
     * @var AMQPChannel
     */
    private $channel;

    private $consumer;

    public function __construct($host, $port, $user, $pass, $vhost, string $consumer = null)
    {
        $this->connection = new AMQPStreamConnection($host, $port, $user, $pass, $vhost);
        $this->channel = $this->connection->channel();
        $this->consumer = $consumer;
        register_shutdown_function([$this, 'close']);
    }

    public function getConnection(): AMQPStreamConnection
    {
        return $this->connection;
    }

    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    public function getConsumer(): string
    {
        return $this->consumer;
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
