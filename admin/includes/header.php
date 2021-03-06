<?php 
	
	if (file_exists("admin/db/panier.csv"))
		$panier = file_get_contents("admin/db/panier.csv");
	if ($panier)
	{
		$i = 0;
		$items = explode("\n", $panier);
		foreach ($items as $item) {
			$array = explode(";", $item);
			$i += $array[1];
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My e-Shop - Rush 42</title>

	<link rel="stylesheet" href="css/style.css">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	
	<!-- Favicon -->
	<link href="img/42.png" rel="icon" type="image/svg">
</head>
<body>

	<nav>

		<a href="index.php" id="logo" class="align-left">My e-Shop</a>
		<ul class="align-right">
			<li><a href="panier.php"><i class="icon-shopping-cart"></i> (<?php if ($panier) { echo $i; } else { ?>0<?php } ?>)</a></li>
			<?php 
				if (isset($_SESSION['loggued_on_user'])) {
			?>
			<li><a href="my_acc.php">My account</a></li>
			<?php 
				if ($_SESSION['admin'] !== "0") {
			?>
			<li><a href="admin/index.php">Admin</a></li>
			<?php } ?>
			<li><a href="logout.php">Logout</a></li>
			<?php 
			} else {
			 ?>
			<li><a href="login.php">Login</a></li>
			<?php } ?>
		</ul>
		<div class="clear"></div>

	</nav>