<?php
namespace MyKeyStore;
use \phpseclib\Crypt\RSA;
$keystore_path=my_var.'/ks';
$keystore_prk = $keystore_path.'/'.my_name.'.prk.xml';
$keystore_pub = $keystore_path.'/'.my_name.'.pub.xml';
if (!is_dir($keystore_path)) mkdir($keystore_path,0700,true);
if (!file_exists($keystore_prk)) {
    $rsa = new RSA();
    $rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_XML);
    $rsa->setPublicKeyFormat(RSA::PUBLIC_FORMAT_XML);
    $keys=$rsa->createKey();
    $fh = fopen($keystore_prk,'c+');
    fprintf($fh,"%s",$keys['privatekey']);
    fclose($fh);
    $fh = fopen($keystore_pub,'c+');
    fprintf($fh,"%s",$keys['publickey']);
    fclose($fh);
}
