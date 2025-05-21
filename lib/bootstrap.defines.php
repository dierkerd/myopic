<?php
defined("SLASH")            || define("SLASH",DIRECTORY_SEPARATOR);
defined("my_root")          || define("my_root",dirname(dirname(__FILE__)));
defined("my_bin")           || define("my_bin",my_root."/bin");
defined("my_lib")           || define("my_lib",my_root."/lib");
defined("my_etc")           || define("my_etc",my_root."/etc");
defined("my_var")           || define("my_var",my_root."/var");
defined("my_tmp")           || define("my_tmp",my_root."/tmp");
defined("my_log")           || define("my_log",my_root."/log");
defined("my_use_pid")       || define("my_use_pid",false);
defined("my_use_log")       || define("my_use_log",false);
defined("my_use_db")        || define("my_use_db",false);
defined("my_use_cache")     || define("my_use_cache",false);
defined("my_start_folder")  || define("my_start_folder",my_var);
defined("my_public")        || define("my_public",my_root.SLASH.'public');

if (!defined("my_name")) define("my_name",pathinfo(debug_backtrace()[1]['file'])['basename']);

date_default_timezone_set('America/Chicago');
