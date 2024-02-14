<?php
//Student-Number-CT-2019-030
session_start();
$_SESSION = array();

session_destroy();
header("Location: login.php");
exit;
?>
