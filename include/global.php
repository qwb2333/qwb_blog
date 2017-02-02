<?php
define("ROOT", dirname(__FILE__));
require ROOT.'/config.php';
require ROOT.'/database.php';
require ROOT.'/data_blog.php';
require ROOT.'/admin.php';
require ROOT.'/filevar.php';
require ROOT.'/smarty.php';

error_reporting(E_ALL^E_NOTICE^E_WARNING);
date_default_timezone_set("PRC");
?>