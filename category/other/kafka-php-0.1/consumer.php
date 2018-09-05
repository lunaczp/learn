<?php
require_once __DIR__ ."/vendor/autoload.php";

$consumer = \Kafka\Consumer::getInstance('localhost:2181');

$consumer->setGroup('testgroup');
$consumer->setPartition('test', 0);
$result = $consumer->fetch();
foreach ($result as $topicName => $topic) {
    foreach ($topic as $partId => $partition) {
        foreach ($partition as $message) {
            var_dump((string)$message);
        }
    }
}

