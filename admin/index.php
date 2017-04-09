<?php

	session_start();

	if (!isset($_SESSION['loggued_on_user']))
		header('Location: ../login.php');
	if ($_SESSION['admin'] === "0")
		header('Location: ../index.php');

?>

<?php require_once("includes/admin-header.php") ?>

<div class="container">

	<h1>Administration</h1>

	<ul>
		<li><a href="list.php">Product List</a></li>
	</ul>

	<ul>
		<li><a href="manage_users.php">Manage users</a></li>
	</ul>
</div>

<?php require_once("includes/footer.php") ?>
