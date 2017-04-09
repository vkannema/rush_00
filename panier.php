<?php

	if (file_exists("admin/db/panier.csv"))
	{
		$file = file_get_contents("admin/db/panier.csv");
		if ($file)
		{
			$tab = file_get_contents("admin/db/panier.csv");
			$products = explode("\n", $tab);
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
	

	<?php

		foreach ($products as $key => $value) {
			if ($products[$key])
			{
				$product = explode(";", $products[$key]);
				?>
				<div class="panier-elem">
					Title : <b><?php echo $product[0]; ?></b> - 
					Quantite : <b><?php echo $product[1]; ?></b> - 

					<a href="edit_product.php?title=<?php echo $product[0];?>
					&url=<?php echo $product[1];?>&price=<?php echo $product[2];?>
					&cat=<?php echo $product[3];?>">Edit</a> - 
					<a href="del_product.php?title=<?php echo $product[0]; ?>">Delete</a>
				</div>
				<?php
			}
		}
	?>

</div>

<?php require_once("admin/includes/footer.php") ?>
