<?php

session_start();
unset($_SESSION['loggued_on_user']);
$_SESSION['admin'] = "0";
header('Location: index.php');

?>
