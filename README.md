
#### 快速起步

---

* 将.env.example文件复制成为.env。填入相应的配置
* 运行 `php cli/test.php`脚本

---

测试分2种

* 利用防火墙丢弃所有TCP包 来达成TCP超时的情况
* 自己写的socket client建立TCP连接后，长时间sleep不回复来达成Socket Read Timeout的情况


---

方法

* `testLongTCPConnect`测试TCP链接连接成功，socket会被Hold住超时时间
* `testExecuteLongTimeSql` Client连接成功之后，后续查询超时时间测试