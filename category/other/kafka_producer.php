<?php
	try {
    $rcf = new RdKafka\Conf();
    $rcf->set('group.id', 'test');
    $cf = new RdKafka\TopicConf();
    $cf->set('offset.store.method', 'broker');
    $cf->set('auto.offset.reset', 'smallest');

    $rk = new RdKafka\Producer($rcf);
    $rk->setLogLevel(LOG_DEBUG);
    $rk->addBrokers("127.0.0.1");
    $topic = $rk->newTopic("test", $cf);
    for($i = 0; $i < 1000; $i++) {
        $topic->produce(0,0,'test' . $i);
	}
} catch (Exception $e) {
    echo $e->getMessage();
}
