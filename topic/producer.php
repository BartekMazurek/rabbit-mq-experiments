<?php

require_once __DIR__.'/vendor/autoload.php';

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

$message = "Test message from TOPIC producer";

$connection = new AMQPStreamConnection('localhost', 5672 ,'guest', 'guest');
$channel = $connection->channel();

$msg = new AMQPMessage($message);

$channel->basic_publish($msg, 'TopicTestExchange', 'randomString.key.randomString');
//$channel->basic_publish($msg, 'TopicTestExchange', 'randomString.randomString.key');
//$channel->basic_publish($msg, 'TopicTestExchange', 'key.randomString.randomString2');

$channel->close();
$connection->close();

echo "Message has been published!";