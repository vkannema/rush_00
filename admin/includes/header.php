<!DOCTYPE html>
<html lang="fr">
<!-- <?php session_start(); ?> -->
<head>
	<meta charset="UTF-8">
	<title>My e-commerce</title>

	<link rel="stylesheet" href="css/style.css">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|400" rel="stylesheet">
</head>
<body>

	<nav>

		<div id="logo" class="align-left">My e-boutique</div>
		<ul class="align-right">
			<li><a href="">Panier(0)</a></li>

			<?php
			if (isset($_SESSION['loggued_on_user']))
			{
				?>
			<li>
				<a href="my_acc.php">Mon compte</a></li>
				<a href="logout.php">Se deconnecter</a>
			</li>
			<?php
		}
		else
		{
			?>
			<li><a href="login.php">Login</a></li>
		<?php
		}
?>
		</ul>
		<div class="clear"></div>

	</nav>
