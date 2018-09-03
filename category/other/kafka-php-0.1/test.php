<?php
	require_once __DIR__ ."/vendor/autoload.php";
	$produce = \Kafka\Produce::getInstance('localhost:2181', 3000);

	$produce->setRequireAck(-1);
	$produce->setMessages('test', 0, array('test1111111'));
	$result = $produce->send();
	var_dump($result);
