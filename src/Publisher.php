<?php

namespace LaravelCode\AMPQ;

use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;

class Publisher
{
    private $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function declare($exchange, $exchangeType = AMQPExchangeType::FANOUT, $passive = false, $durable = true, $autoDelete = false)
    {
        $this->connection->getChannel()->exchange_declare($exchange, $exchangeType, $passive, $durable, $autoDelete);
    }

    public function write($exchange, $payload = [])
    {
        $message = new AMQPMessage(json_encode($payload), ['content_type' => 'application/json', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
        $this->connection->getChannel()->basic_publish($message, $exchange);
        $this->connection->close();
    }
}
