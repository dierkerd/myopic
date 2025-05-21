<?php
$logger = new \Monolog\Logger(my_name);
$logfile = my_log . "/" . my_name . '.' . date('Ymd') . '.log';
$logger->pushHandler(new \Monolog\Handler\StreamHandler($logfile, \Monolog\Logger::DEBUG));
if (defined("STDOUT")) { /** STDOUT not defined for web pages */
    define("LOGGING_JOB",true);
    if (posix_isatty(STDOUT)) {
        $logger->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout', \Monolog\Logger::DEBUG));
    }
    else {
        $logger->pushHandler(new \Monolog\Handler\StreamHandler('php://stderr',\Monolog\Logger::WARNING));
    }
}
else {
    define("LOGGING_JOB",false);
}
function blather($msg) {
    global $logger,$debug;
    if ($debug) {
        $args = func_get_args();
        $msg = call_user_func_array('sprintf',$args);
        if (LOGGING_JOB) {
            $logger->debug($msg);
        }
        else {
            $logger->debug($msg,['ip'=>$_SERVER['REMOTE_ADDR']]);
        }
    }
}

function say($msg) {
    global $logger;
    $args = func_get_args();
    $msg = call_user_func_array('sprintf',$args);
    if (LOGGING_JOB) {
        $logger->info($msg);
    }
    else {
        $logger->info($msg,['ip'=>$_SERVER['REMOTE_ADDR']]);
    }
}


function carp($msg) {
    global $logger;
    $args = func_get_args();
    $msg = call_user_func_array('sprintf',$args);
    if (LOGGING_JOB) {
        $logger->warning($msg);
    }
    else {
        $logger->warning($msg,['ip'=>$_SERVER['REMOTE_ADDR']]);
    }
}
?>
