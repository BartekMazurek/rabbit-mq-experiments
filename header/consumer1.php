<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
    var_dump($msg->get('application_headers'));
  };
  
  $channel->basic_consume('QueueName1', '', false, true, false, false, $callback);
  
  while ($channel->is_consuming()) {
      $channel->wait();
  }

  $channel->close();
  $connection->close();