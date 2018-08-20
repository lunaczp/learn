# Note on RabbitMQ

## Random Notes
**Durability**
- rabbitmq是内存型的消息队列：
	- 当没有显式说明队列是持久化的，那么队列就是临时的（内存中），当rabbitmq server重启，队列就不存在了。
	- 当没有显式说明消息是持久化的，消息也是临时的（内存中），当rabbitmq server重启，而且消息没有被消费，消息就不存在了。
	- 默认消息在内存中，消费后就会被标记清除。
		- 当开启了ack配置，而大量消息没有被ack(没有来得及，或者代码bug忘了ack)的情况下，server的内存可能会被撑爆。

注意：即使开启了持久化，rabbitmq底层也不会对每个消息进行`fsync`，所以也不是百分之百的不丢消息。如果需要更强的约束，可以使用[Publisher Confirm机制](https://www.rabbitmq.com/confirms.html)

**Ack**
- 消息消费默认是不发送ack，但是可以使用，使用的时候：
	- 在消费端激活ack配置
	- 在消费代码内添加ack代码

__注意__：如果开启了ack配置，但是代码内忘记了ack，那么消息就会一直存在于server的内存中，有可能会撑爆server内存。
