<?php
	date_default_timezone_set("Asia/Shanghai");
	$t1 = microtime(true);
	try {
		$rcf = new RdKafka\Conf();

		//$rcf->set('socket.timeout.ms', 50);
		//$rcf->set('socket.blocking.max.ms', 50);
		//$rcf->set('internal.termination.signal', SIGIO);
		//pcntl_sigprocmask(SIG_BLOCK, [SIGIO]);

		$rcf->set('group.id', 'test');
		$cf = new RdKafka\TopicConf();
		$cf->set('offset.store.method', 'broker');
		$cf->set('auto.offset.reset', 'smallest');

		$rk = new RdKafka\Producer($rcf);
		$rk->setLogLevel(LOG_DEBUG);
		$rk->addBrokers("127.0.0.1");
		$topic = $rk->newTopic("test", $cf);
		$topic->produce(0,0,'test' . "one".date("Y-m-d H:i:s"));
		//while ($rk->getOutQLen() > 0) {
		//	$rk->poll(1);
		//}
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	$t2 = microtime(true);

	$int = ($t2-$t1)*1000;
	echo $int;
