<?php
	try {
		$rcf = new RdKafka\Conf();
		$rcf->set('group.id', 'test');
		$cf = new RdKafka\TopicConf();
		$cf->set('auto.offset.reset', 'smallest');
		$cf->set('auto.commit.enable', true);

		$rk = new RdKafka\Consumer($rcf);
		$rk->setLogLevel(LOG_DEBUG);
		$rk->addBrokers("127.0.0.1");
		$topic = $rk->newTopic("test", $cf);
		while (true) {
			$topic->consumeStart(0, RD_KAFKA_OFFSET_STORED);
			$msg = $topic->consume(0, 1000);
			var_dump($msg);
			if ($msg->err) {
				echo $msg->errstr(), "\n";
				break;
			} else {
				echo $msg->payload, "\n";
			}
			$topic->consumeStop(0);
			sleep(1);
		}
	} catch (Exception $e) {
		echo $e->getMessage();
	}
