<?php
$ini = parse_ini_file (my_var.'/.my.cnf',true);
$db_ini = (empty($ini[my_name]) ? $ini['production'] : $ini[my_name]);
$db_user = $db_ini['user'];
$db_pswd = $db_ini['password'];
$db_host = $db_ini['host'];
$db_db   = $db_ini['database'];
$db_opt  = array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

try {
    if (defined("my_use_f3") && my_use_f3) {
        $f3->set("DB",new \DB\SQL(sprintf("mysql:dbname=%s; host=%s",$db_db,$db_host), $db_user, $db_pswd, $db_opt));
        $dbh = $f3->get("DB")->pdo();
    }
    else {
        $dbh = new PDO(sprintf("mysql:dbname=%s; host=%s",$db_db,$db_host), $db_user, $db_pswd, $db_opt);
    }
}
catch (PDOException $e) {
    carp("DB/PDO connection error: %s",$e->getMessage());
    carp("DB/PDO details: %s",print_r($e,true));
    throw $e;
}
