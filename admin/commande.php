<?php 

	if (file_exists("db/commande.csv"))
	{
		$file = file_get_contents("db/commande.csv");
		$commandes = explode("\n", $file);
	}

?>

<?php require_once("includes/admin-header.php") ?>

<div class="container">
		
	<?php echo $error; ?>
	
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
					<b><?php echo $commande[0]; ?></b> a commande 
					pour <b><?php echo $commande[1]; ?>$</b> ! It rocks !
				</div>
				<?php
			}
		}
	}
	else {
		?><p>Vous n'avez encore rien vendu ! Bougez vous le cul !</p><?php
	}
	?>

</div>

<?php require_once("includes/footer.php") ?>