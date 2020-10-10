# AMPQ integration for laravel

This package is a laravel wrapper for  ```php-amqplib/php-amqplib```.

## Installation

``composer require laravevl-code/ampq``

Laravel will automatically discover this package.

After installation the config file should be published with the following command.
``php artisan vendor:publish --tag=ampq``


## Publisher

The ``Publisher`` is available through dependency injection and as a facade.

### write()
Use this to create the exchange when you have not setup an exchange manually.
This step is not necessary when the exchange already exists.

``declare($exchange, $exchangeType = AMQPExchangeType::FANOUT, $passive = false, $durable = true, $autoDelete = false)``

### write()
Write the message on to the exchange.

``write($exchange, $payload = [])``

## Consumer

Consume messages from the queue.

## declare()

Will create the exchange and queue. The queue will get bind to the exchange.
This step is not necessary when you have not a;ready setup the exchange and queue.

``declare($exchange, $queue, $exchangeType = AMQPExchangeType::FANOUT, $exclusive = false, $passive = false, $durable = true, $autoDelete = false)``

## read()

Read the message from the queue.
You most provide a callback function the will get called when a message is received.

``read($exchange, $queue, $callback)``

```php
<?php

function message(AMQPMessage $message) {
    var_dump($message->body);
    $message->ack();
}
```



