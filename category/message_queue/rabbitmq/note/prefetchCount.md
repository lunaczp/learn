# Prefetch Count 与阻塞
当消费者进程很慢时，队列阻塞了10条消息。此时再开一个消费者进程，发现并没有收到消息，而只有当有第11条信息进来的时候，新进程才收到。
因为之前的10条都发给了第一个消费者（尽管它的第一条消息的ack还没返回。）这就是因为prefetchCount=0（默认值）。

prefetchCount会让消费者一次拿到多条消息。
see [prefetchCount](prefetchCount/)