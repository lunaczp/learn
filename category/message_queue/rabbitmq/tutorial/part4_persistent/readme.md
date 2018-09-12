一下所有例子中，exchange，queue，message都是持久化的（duration）
# Case 1
一个producer，一个consumer
```
> php emit_log_direct.php warning 8 #producer
> php receive_logs_direct.php warnging #consumer
```

# Case 2
一个producer，两个consumer用同一个queue，绑定同一个routing_key
```
> php emit_log_direct.php warning 8 #producer
> php receive_logs_direct.php warnging #consumer
> php receive_logs_direct.php warnging #consumer
```

效果：Robbin-round分发

备注：示例是使用的direct模式的exchange。对于topic模式的exchange也是一样的。两个进程绑定同一个queue，则server会采用Robbin-round分发的模式发送消息。

# Case 3
一个producer，两个consumer用同一个queue，绑定不同routing_key
```
> php emit_log_direct.php warning 8 #producer
> php receive_logs_direct.php warnging #consumer
> php receive_logs_direct.php error #consumer
```

效果：两个进程分别为queue绑定的routing_key都生效了。也即为queue绑定的routing_key最终是求并集

# Case 4
一个producer，两个consumer用不同的queue
```
> php emit_log_direct.php warning 8 #producer
> php receive_logs_direct.php warnging #consumer
> php receive_logs_direct_queue2.php warnging #consumer
```

效果：广播


注意，以上都实现了持久化，即消费者退出后，生产者继续生产，当消费者重启启动，可以消费到期间没有消费的消息。
