<?php
defined("my_use_f3")    || define("my_use_f3",false);
defined("SLASH")        || define("SLASH",DIRECTORY_SEPARATOR);
defined("my_root")      || define("my_root",dirname(dirname(__FILE__)));

require(dirname(dirname(__FILE__))."/lib/bootstrap.defines.php");

if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

if(!empty($_SERVER["HTTP_X_FORWARDED_PROTO"]) and $_SERVER["HTTP_X_FORWARDED_PROTO"] == 'http') {
    $redirect='https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];
    header('location: '.$redirect);
    exit;
}

require(my_root."/lib/vendor/autoload.php");

chdir(my_start_folder);

if(my_use_log)   require(my_lib."/bootstrap.logging.php");
if(my_use_cache) require(my_lib."/bootstrap.cache.php");
if(my_use_f3)    require(my_lib."/bootstrap.f3.php");
if(my_use_db)    require(my_lib."/bootstrap.db.php");
?>
