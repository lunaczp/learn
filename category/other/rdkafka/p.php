<?php
	date_default_timezone_set("Asia/Shanghai");

	$rk = new RdKafka\Producer();
	$rk->setLogLevel(LOG_DEBUG);
	$rk->addBrokers("127.0.0.1");

	$topic = $rk->newTopic("testEventClientRKafka-P2");
	$topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message payload");
	//$topic->produce(0, 0, "Message payload");

