<?php

require_once __DIR__.'/vendor/autoload.php';

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Wire\AMQPTable;

$message = "Test message from HEADERS producer";

$connection = new AMQPStreamConnection('localhost', 5672 ,'guest', 'guest');
$channel = $connection->channel();

$headers = [
    'val1' => 'mobile',
    'val2' => 'phone'
];

$headers2 = [
    'val1' => 'tv',
    'val2' => 'television'
];

$header = new AMQPTable($headers);

$msg = new AMQPMessage($message);
$msg->set('application_headers', $header);

$channel->basic_publish($msg, 'HeadersTestExchange', '');

$channel->close();
$connection->close();

echo "Message has been published!";