<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>My e-commerce</title>

	<link rel="stylesheet" href="css/style.css">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet">
	
	<!-- Favicon -->
	<link href="img/42.png" rel="icon" type="image/svg">
</head>
<body>

	<nav>

		<div id="logo" class="align-left">My e-boutique</div>
		<ul class="align-right">
			<li><a href="product.php">Panier(0)</a></li>
			<?php 
				if ($_SESSION['admin'] !== "0") {
			?>
			<li><a href="admin/index.php">Admin</a></li>
			<?php 
			}
				if (isset($_SESSION['loggued_on_user'])) {
			
			?>
			<li><a href="my_acc.php">Mon compte</a></li>
			<li><a href="logout.php">Logout</a></li>
			<?php 
			} else {
			 ?>
			<li><a href="login.php">Login</a></li>
			<?php } ?>
		</ul>
		<div class="clear"></div>

	</nav>