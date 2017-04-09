<?php 

	if (file_exists("db/commande.csv"))
	{
		$file = file_get_contents("db/commande.csv");
		$commandes = explode("\n", $file);
	}

?>

<?php require_once("includes/admin-header.php") ?>

<div class="container">
	
	<a href="index.php" class="grey-button">Back</a>
	<h1>Your Orders</h1>

	<?php
	if ($file)
	{
		foreach ($commandes as $key => $value) {
			if ($commandes[$key])
			{
				$commande = explode(";", $commandes[$key]);
				?>
				<div class="product">
					<b><?php echo $commande[0]; ?></b> ordered 
					for <b><?php echo $commande[1]; ?>$</b> ! It rocks ! - 
					<a href="del_order.php?id=<?php echo $key; ?>" title="delete"><i class="icon-trash"></i> Delete</a>
				</div>
				<?php
			}
		}
	}
	else {
		?><p>You sell nothing yet ! Move your ass !</p><?php
	}
	?>

</div>

<?php require_once("includes/footer.php") ?>