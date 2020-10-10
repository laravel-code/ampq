<?php

return [
    'host' => env('AMPQ_HOST'),
    'port' => env('AMPQ_PORT', 5672),
    'user' => env('AMPQ_USER'),
    'pass' => env('AMPQ_PASS'),
    'vhost' => env('AMPQ_VHOST'),
    'consumer' => env('AMPQ_CONSUMER'),
    'queue' => env('AMPQ_QUEUE'),
    'exchange' => env('AMPQ_EXCHANGE'),
];
