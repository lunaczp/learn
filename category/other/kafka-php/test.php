<?php
	$t1 = microtime(true);
	require 'vendor/autoload.php';
	date_default_timezone_set('PRC');

	$config = \Kafka\ProducerConfig::getInstance();
	$config->setMetadataRefreshIntervalMs(10000);
	$config->setMetadataBrokerList('127.0.0.1:9092');
	$config->setBrokerVersion('1.0.0');
	$config->setRequiredAck(1);
	$config->setIsAsyn(false);
	$config->setProduceInterval(500);
	$producer = new \Kafka\Producer();

	$producer->send([
	[
	'topic' => 'test',
	'value' => 'test1....message.',
	'key' => '',
	],
	]);

	$t2 = microtime(true);
	$int = ($t2-$t1)*1000;
	echo $int;
