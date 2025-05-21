<?php 
defined("my_use_pid")       || define("my_use_pid",true);
defined("my_use_log")       || define("my_use_log",true);
defined("my_use_f3")        || define("my_use_f3",false);
defined("my_use_keys")      || define("my_use_keys",false);
defined("my_use_job")       || define("my_use_job",true);
ob_start();
require(dirname(dirname(__FILE__))."/lib/bootstrap.defines.php");
require(my_root."/lib/vendor/autoload.php");
chdir(my_start_folder);
if(my_use_log)   require(my_lib."/bootstrap.logging.php");
if(my_use_pid)   require(my_lib."/bootstrap.pid.php");
if(my_use_cache) require(my_lib."/bootstrap.cache.php");
if(my_use_f3)    require(my_lib."/bootstrap.f3.php");
if(my_use_db)    require(my_lib."/bootstrap.db.php");
if(my_use_keys)  require(my_lib."/bootstrap.keys.php");
ob_end_clean();

function job_runTime() {
    global $job_start;
    $d[0] = array(1,"second");
    $d[1] = array(60,"minute");
    $d[2] = array(3600,"hour");
    $d[3] = array(86400,"day");
    $d[4] = array(604800,"week");
    $d[5] = array(2592000,"month");
    $d[6] = array(31104000,"year");
    $w = array();
    $return = "";
    $secondsLeft = time() - $job_start;
    for($i=6;$i>-1;$i--)
    {
        $w[$i] = intval($secondsLeft/$d[$i][0]);
        $secondsLeft -= ($w[$i]*$d[$i][0]);
        if($w[$i]!=0)
        {
            $return.= abs($w[$i]) . " " . $d[$i][1] . (($w[$i]>1)?'s':'') ." ";
        }
        
    }
    return $return;
}
$job_start=time();
