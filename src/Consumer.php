<?php

namespace LaravelCode\AMPQ;

use PhpAmqpLib\Exchange\AMQPExchangeType;

class Consumer
{
    private $connection;

    private $callback;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function declare($exchange, $queue, $exchangeType = AMQPExchangeType::FANOUT, $exclusive = false, $passive = false, $durable = true, $autoDelete = false)
    {
        $this->connection->getChannel()->queue_declare($queue, $passive, $durable, $exclusive, $autoDelete, );
        $this->connection->getChannel()->exchange_declare($exchange, $exchangeType, $passive, $durable, $autoDelete);
        $this->connection->getChannel()->queue_bind($queue, $exchange);
    }

    public function read($exchange, $queue, $callback)
    {
        $this->callback = $callback;

        $this->connection->getChannel()->basic_consume($queue, $this->connection->getConsumer(), false, false, false, false, $callback);

        while ($this->connection->getChannel()) {
            $this->connection->getChannel()->wait();
        }
    }
}
