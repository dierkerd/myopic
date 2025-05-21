<?php 
defined("SLASH")        || define("SLASH",DIRECTORY_SEPARATOR);
defined("my_root")      || define("my_root",dirname(dirname(__FILE__)));
define("my_name","cstools");
define("my_use_f3",true);
define("my_use_cache",false);
define("my_use_db",true);
define("my_use_log",true);
$debug=true;
require(my_root."/lib/bootstrap.web.php");
$f3->set("UI",my_etc.'/ui/');
$f3->set("TEMPLATE",\Template::instance());
$f3->run();

?>
	
