
#### 快速起步

---

* 将.env.example文件复制成为.env。填入相应的配置
* 运行 `php cli/test.php`脚本

方法

* `testLongTCPConnect`测试TCP链接连接成功，socket会被Hold住超时时间
* `testExecuteLongTimeSql` Client连接成功之后，后续查询超时时间测试