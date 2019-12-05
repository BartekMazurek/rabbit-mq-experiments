<?php

require_once __DIR__.'/vendor/autoload.php';

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

$message = "Test message in Direct Exchange";

$connection = new AMQPStreamConnection('localhost', 5672 ,'guest', 'guest');
$channel = $connection->channel();

$msg = new AMQPMessage($message);

$channel->basic_publish($msg, 'ExchangeName', 'routingKey');
//$channel->basic_publish($msg, 'ExchangeName', 'routingKey2');
//$channel->basic_publish($msg, 'ExchangeName', 'routingKey3');

$channel->close();
$connection->close();

echo "Message has been sent to direct exchange!";
