<?php

require_once __DIR__.'/vendor/autoload.php';

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

$message = "Test message from FANOUT producer";

$connection = new AMQPStreamConnection('localhost', 5672 ,'guest', 'guest');
$channel = $connection->channel();

$msg = new AMQPMessage($message);

$channel->basic_publish($msg, 'ExchangeName', '');

$channel->close();
$connection->close();

echo "Message has been published!";