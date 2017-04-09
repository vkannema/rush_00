<?php

	session_start();

	if (file_exists("admin/db/panier.csv"))
	{
		$file = file_get_contents("admin/db/panier.csv");
		if ($file)
		{
			$tab = file_get_contents("admin/db/panier.csv");
			$products = explode("\n", $tab);
		}
		else
			$message = "Your shopping list is empty !";
	}
	else
		$error = "panier.csv doesn't exist !\n";

?>

<?php require_once("admin/includes/header.php") ?>

<div class="container">

	<?php echo $error; ?>

	<a href="index.php" class="grey-button">Back</a>

	<h1>Shopping List</h1>

	<p><?php echo $message; ?></p>
	
	<?php
	$total = 0;
	if ($file) {
		foreach ($products as $key => $value) {
			if ($products[$key])
			{
				$product = explode(";", $products[$key]);
				?>
				<div class="panier-elem">
					Title : <b><?php echo $product[0]; ?></b> - 
					Amount : <b><?php echo $product[1]; ?></b> - 
					Price : <b><?php echo $product[2]; ?>$</b>
				</div>
				<?php
				$price += $product[2];
			}
		}
	}

	if ($file) {
	?>
	<div class="panier-elem price">
		Total : <b class="green"><?php echo $price; ?>$</b>
		<a href="delete_b.php" class="del"> - delete</a>
		<?php 

			if (isset($_SESSION['loggued_on_user']))
			{
				?><a href="validate.php?user=<?php echo $_SESSION['loggued_on_user']; ?>
				&price=<?php echo $price; ?>" class="green-button align-right">Order !</a><?php
			}
			else 
			{ ?><a href="login.php" class="red-button align-right">Log in !</a><?php
			}
	}?>
		
	</div>

</div>

<?php require_once("admin/includes/footer.php") ?>
