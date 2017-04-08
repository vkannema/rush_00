<?php

	if (file_exists("admin/db/panier.csv"))
	{
		$file = file_get_contents("admin/db/panier.csv");
		if ($file)
		{
			//$products = explode("\n", $file);
			$message = "Votre panier est plein !";
			$tab = file_get_contents("admin/db/panier.csv");
		}
		else
			$message = "Votre panier est vide !";
	}
	else
		$error = "panier.csv doesn't exist !\n";

?>

<?php require_once("admin/includes/header.php") ?>

<div class="container">

	<?php echo $error; ?>

	<a href="index.php">Back</a>

	<h1>Panier</h1>
	<p><?php echo $message; ?></p>
	<?php echo $tab; ?>

</div>

<?php require_once("admin/includes/footer.php") ?>
