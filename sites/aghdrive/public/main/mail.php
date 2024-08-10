<?php
include_once '../../application/config/main/config.php';

$smtpinfo = &PEAR::getStaticProperty('App', 'smtpinfo');
$smtpinfo["host"] = "ssl://poczta.agh.edu.pl";
$smtpinfo["port"] = "465";
$smtpinfo["auth"] = true;
$smtpinfo["username"] = "drive@agh.edu.pl";
$smtpinfo["password"] = "Fu7d-ipi1t";
$smtpinfo["from"] = "drive@agh.edu.pl";
$smtpinfo["debug"] = true;
$smtpinfo["socket_options"] = array(
    "ssl"=>array(
        "cafile" => "/etc/ssl/certs/local/cacert.pem",
        "verify_peer"=>true,
        "verify_peer_name"=>true,
    ),
);

$email_body = "Hello,<br/><br/>Please click into this link:<br/>";

App::sendEmail('mdlugosz@gmail.com', 'drive@agh.edu.pl', '[AGHDrive] Reset password', $email_body);