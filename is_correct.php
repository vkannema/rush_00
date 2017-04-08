<?php
include("auth.php");
if ($_POST['login'] && $_POST['passwd'])
{
if (auth($_POST['login'], $_POST['passwd']) == TRUE)
{
	session_start();
	$_SESSION['loggued_on_user'] = $_POST['login'];
	header('Location: index.php');
}
else
	header('Location: error/wrong_id.php');
}
else
	echo "ERROR2\n";
?>
