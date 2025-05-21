<?php
defined("JOB_PID_PATH")           || define("JOB_PID_PATH",my_var.'/'.my_name.'.pid');
defined("JOB_PID_PATH_WEDGED")    || define("JOB_PID_PATH_WEDGED",JOB_PID_PATH.".wedged");
defined("JOB_PID_CURRENT")        || define("JOB_PID_CURRENT",posix_getpid());
defined("JOB_PID_MAXAGE")         || define("JOB_PID_MAXAGE",60 * 60);

function job_pid_heartbeat() {
    touch(JOB_PID_PATH);
}

if ($job_pid_fh=fopen(JOB_PID_PATH,'c+')) {
    if (!flock($job_pid_fh,LOCK_EX|LOCK_NB)) {
        $job_pid_age = time() - filemtime(my_var.'/'.my_name.'.pid');
        if($job_pid_age > JOB_PID_MAXAGE) {
          $job_pid_other = file_get_contents(JOB_PID_PATH);
          if(!file_exists(JOB_PID_PATH.'-wedged')) {
              carp('Job "%s" appears wedged, pid=%d.',my_name,$job_pid_other);
              copy(JOB_PID_PATH,JOB_PID_PATH,JOB_PID_PATH_WEDGED);
          }
        }
        fclose($job_pid_fh);
        exit;
    }
    ftruncate($job_pid_fh,0);
    fprintf($job_pid_fh,"%d\n",JOB_PID_CURRENT);
    fflush($job_pid_fh);
    if(file_exists(JOB_PID_PATH_WEDGED)) {
        $job_pid_other = file_get_contents(JOB_PID_PATH);
        unlink(JOB_PID_PATH_WEDGED);
        carp('Job %s was wedged, old pid=%d, cleanup done.',my_name,$job_pid_other);
    }
    register_shutdown_function(function() use ($job_pid_fh) {
        ftruncate($job_pid_fh,0);
        flock($job_pid_fh, LOCK_UN);
        fclose($job_pid_fh);
    });
}
else {
   carp("Unable to create pid file: %s",JOB_PID_PATH);
   exit;
}
