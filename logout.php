<?php

session_start();
unset($_SESSION['loggued_on_user']);
$_SESSION['admin'] = "0";
file_put_contents("admin/db/panier.csv", "");
header('Location: index.php');

?>
