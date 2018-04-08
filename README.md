# qwb_blog

### 1.申请多说账号
记录好short_name 和 secreet_key

设置多说设置面板->工具->反向同步，设置为`{HTTP_ROOT}ajax_reupdate.php`

HTTP_ROOT为根目录地址，参见config.php中含义

### 2.配置include/config.php文件
```php
<?php
define("DATA_HOST", "localhost");//数据库地址
define("DATA_USER", "root");//数据库账号
define("DATA_PASS", "11111111");//数据库密码
define("DATA_DATABASE", "qwb");//数据库表

define("HTTP_ROOT", "http://127.0.0.1/blog/");//根目录地址
define("ADMIN_PASS", "123456");//文章管理密码
define("BLOG_DOMAIN", "bbs.csustacm.com");//显示在最下面的
define("BLOG_NAME", "qwb's blog");//博客名
define("BLOG_MESSAGE", "——愿你有一天能与你最重要的人重逢");//留言板文字
define("PAGE_NUM", 7);//一页显示多少篇文章

define("CHANGYAN_APPID", "xxx");//畅言的APPID
define("CHANGYAN_CONF", "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");//畅言的conf

define("CONTACT_ME", "http://wpa.qq.com/msgrd?v=3&uin=492859377&site=qq&menu=yes");//最下面的联系方式
?>
```

### 3.导入sql文件
将include/mysql.sql导入到对应的数据库表
----------------------------------
配置全部完成，现在就可以使用拉~

管理地址为`{HTTP_ROOT}admin.php`
