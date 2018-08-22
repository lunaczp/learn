<?php
require_once __DIR__ . '/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('persist_direct_logs', 'direct', false, true, false);

$queue_name = "persist_logs_queue";
$channel->queue_declare($queue_name, false, true, false, false);

$severities = array_slice($argv, 1);
if (empty($severities)) {
    file_put_contents('php://stderr', "Usage: $argv[0] [info] [warning] [error]\n");
    exit(1);
}

foreach ($severities as $severity) {
    $channel->queue_bind($queue_name, 'persist_direct_logs', $severity);
}

echo " [*] Waiting for logs. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] ', $msg->delivery_info['routing_key'], ':', $msg->body, "\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);//ack
};

$channel->basic_consume($queue_name, '', false, false, false, false, $callback);//open ack

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();