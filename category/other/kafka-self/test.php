<?php
$producer = new \Gaea\Client\Producer();

$r = $producer->publish("test", "xxx");
var_export($r);
