<?php
require ROOT.'/smarty/libs/Smarty.class.php';

$smarty = new Smarty();
$smarty->caching = true;
$smarty->cache_lifetime = 3600;
?>