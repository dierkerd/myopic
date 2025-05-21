<?php
defined("my_use_job")       || define("my_use_job",false);
defined("my_use_f3")        || define("my_use_f3",true);
$f3=\Base::instance();

/**
 * Pass into F3 some of the standard MY_* vars
 */
foreach([
		 'MY_ETC'=>my_etc,
		 'MY_VAR'=>my_var,
		 'MY_NAME'=>my_name
		 ] as $k=>$v) {
	$f3->set($k,$v);
}
/**
 * Load in the config files
 */
$f3->config(my_etc."/f3.ini",true);
/**
 * Look for any site specific inis that are NOT stored in GIT.
 */
foreach (new DirectoryIterator(my_etc.SLASH.'.local') as $fileInfo) {
    if($fileInfo->isDot()) continue;
    if($fileInfo->getExtension() == 'ini') {
        $f3->config(my_etc.SLASH.'.local'.SLASH.$fileInfo->getFilename(),true);
    }
}

$f3->set("TEMP",my_tmp.'/');
if (!is_dir(my_var.'/f3-cache')) mkdir(my_var.'/f3-cache',0770,true);
$f3->set("CACHE",'folder='.my_var.'/f3-cache/');
if (!is_dir(my_tmp."/uploads")) mkdir(my_tmp."/uploads",0777,true);
$f3->set("UPLOADS",my_tmp."/uploads/");
$f3->set("UI",my_etc.'/ui/');
$f3->set("HOME",$f3->get('SCHEME').'://'.$f3->get('HOST').$f3->get('BASE').'/');
$f3->set('FLASH',\App\Flash::instance());
\Preview::instance()->filter('urlencode','urlencode');
\Preview::instance()->filter('json','json_encode');
$f3->set('ONERROR',function($f3) {
    $code = $f3->get('ERROR.code');
    $template=\Template::instance();
    $error_html = $template->render('email/error.html');
    $error_txt  = $template->render('email/error.txt');
    while (ob_get_level()) 
      ob_end_clean();
    if(my_use_job) {
        carp("Error %s - %s",$f3->get('ERROR.code'),$f3->get('ERROR.status'));
        carp("... %s",$f3->get("ERROR.text"));
        foreach(explode(PHP_EOL,$f3->get("ERROR.trace")) as $line) carp("... %s",$line);
    }
    else {
        if ($code != '404') {
            echo $template->render('error.html');
        }
        else {
            echo $template->render('404.html');
        }
    }

    if ($code != '404') {
        $transport = new Swift_SmtpTransport('localhost', 25);
        $mailer    = new Swift_Mailer($transport);
        $message   = new  Swift_Message(sprintf("Error on %s, %s - %s: %s",$f3->get('HOST'),$f3->get('ERROR.code'),$f3->get('ERROR.status'),$f3->get("ERROR.text")));
        $message->setFrom([$f3->get('REPLY_TO') => $f3->get('SITE_SHORT_NAME')]);
        $message->setTo(['ddierker@stltoday.com']);
        $message->setBody($error_txt);
        $message->addPart($error_html,'text/html');
        $mailer->send($message);
    }
});
